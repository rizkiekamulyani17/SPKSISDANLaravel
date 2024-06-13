<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CriteriaPerbadinganRequest;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\CriteriaAnalysis;
use App\Models\CriteriaAnalysisDetail;
use App\Models\PriorityValue;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AhpController extends Controller
{
    // check jika ada kriteria

    public function show(CriteriaAnalysis $criteriaAnalysis)
    {
        $criteriaAnalysis->load('priorityValues');

        $criterias = CriteriaAnalysisDetail::getSelectedCriterias($criteriaAnalysis->id);
        $criteriaIds = $criterias->pluck('id');
        $alternatives = Alternative::getAlternativesByCriteria($criteriaIds);
        $dividers = Alternative::getDividerByCriteria($criterias);

        $normalizations = $this->_hitungNormalisasi($dividers, $alternatives);

        // dd($normalizations);
        return view('pages.admin.ahp.detailr', [
            'title' => 'Normalisasi Tabel',
            'dividers' => $dividers,
            'normalizations' => $normalizations,
            'criteriaAnalysis' => $criteriaAnalysis,
        ]);
    }
    private function checkIfAbleToRank()
    {
        $availableCriterias = Criteria::all()->pluck('id');
        return Alternative::checkAlternativeByCriterias($availableCriterias);
    }

    // menghitung perbandingan
    private function _countRestDetails($criteriaAnalysisId, $detailIds)
    {
        // get semua data perbandingan yang tidak dimasukkan pengguna nilainya
        $restDetails = CriteriaAnalysisDetail::where('criteria_analysis_id', $criteriaAnalysisId)
            ->whereNotIn('id', $detailIds)
            ->get();

        // count and update nilai perbandingan
        if ($restDetails->count()) {
            $restDetails->each(function ($value, $key) use ($criteriaAnalysisId) {
                $prevComparison = CriteriaAnalysisDetail::where([
                    'criteria_analysis_id' => $criteriaAnalysisId,
                    'criteria_id_first'    => $value->criteria_id_second,
                    'criteria_id_second'   => $value->criteria_id_first,
                ])->first();
                // perbandingan hasil
                $comparisonResult = 1 / $prevComparison['comparison_value'];
                $comparisonValue = $prevComparison['comparison_value'];
                CriteriaAnalysisDetail::where([
                    'criteria_analysis_id' => $criteriaAnalysisId,
                    'criteria_id_first'    => $value->criteria_id_first,
                    'criteria_id_second'   => $value->criteria_id_second,
                ])->update([
                    'comparison_result' => $comparisonResult,
                    'comparison_value' => $comparisonValue,
                ]);
            });
        }
    }

    // penjumlahan kriteria
    private function _getTotalSumPerCriteria($criteriaAnalysisId, $criterias)
    {
        $result = [];
        foreach ($criterias as $criteria) {
            $totalPerCriteria = CriteriaAnalysisDetail::where([
                'criteria_analysis_id' => $criteriaAnalysisId,
                'criteria_id_second'   => $criteria->id
            ])->sum('comparison_result');
            $data = [
                'kriteria' => $criteria->nama_kriteria,
                'totalSum'      => floatval($totalPerCriteria)
            ];
            array_push($result, $data);
        }
        return $result;
    }

    // hitung normalisasi
    private function _hitungNormalisasi($dividers, $alternatives)
    {
        $normalisasi = [];
        foreach ($alternatives as $alternative) {
            $normalisasiAngka = [];
            foreach ($alternative['alternative_val'] as $key => $val) {
                if ($val == 0) {
                    $dividers = 0;
                }
                $kategori = $dividers[$key]['kategori'];
                if ($kategori === 'BENEFIT' && $val != 0) {
                    $result = substr(floatval($val / $dividers[$key]['divider_value']), 0, 11);
                }
                if ($kategori === 'COST' && $val != 0) {
                    $result = substr(floatval($dividers[$key]['divider_value'] / $val), 0, 11);
                }
                array_push($normalisasiAngka, $result);
            }
            array_push($normalisasi, [
                'siswa_id'       => $alternative['siswa_id'],
                'siswa_name'     => $alternative['siswa_name'],
                'kelas_name'      => $alternative['kelas_name'],
                'criteria_name'   => $alternative['criteria_name'],
                'criteria_id'     => $alternative['criteria_id'],
                'alternative_val' => $alternative['alternative_val'],
                'results'         => $normalisasiAngka
            ]);
        }
        // Menambahkan orderby berdasarkan nama destinasi (siswa_name) secara naik (ascending)
        $normalisasi = collect($normalisasi)->sortBy('siswa_name')->values()->all();
        return $normalisasi;
    }

    // menghitung eigen vector
    private function _countPriorityValue($criteriaAnalysisId)
    {
        // get semua kriteria yang dipilih by user
        $criterias = CriteriaAnalysisDetail::getSelectedCriterias($criteriaAnalysisId);
        // loop criteria
        foreach ($criterias as $criteria) {
            // get semua nilai perbandingan dari first criteria id yang cocok dengan loop criteria id
            $dataDetails = CriteriaAnalysisDetail::select('criteria_id_second', 'comparison_result')
                ->where([
                    'criteria_analysis_id' => $criteriaAnalysisId,
                    'criteria_id_first'    => $criteria->id
                ])->get();
            // nilai prioritas sementara
            $tempValue = 0;
            // loop nilai perbandingan
            foreach ($dataDetails as $detail) {
                $totalPerCriteria = CriteriaAnalysisDetail::where([
                    'criteria_analysis_id' => $criteriaAnalysisId,
                    'criteria_id_second'   => $detail->criteria_id_second
                ])->sum('comparison_result');
                // eigen vector sementara
                $res = substr($detail->comparison_result / $totalPerCriteria, 0, 11);
                $tempValue += $res;
            }
            // final prioritas value = nilai sementara / jumlah total kriteria
            $FinalPrevValue = $tempValue / $criterias->count();
            $data = [
                'criteria_analysis_id' => $criteriaAnalysisId,
                'criteria_id'          => $criteria->id,
                'value'                => floatval($FinalPrevValue),
            ];
            // insert or create jika tidak ada
            PriorityValue::updateOrCreate([
                'criteria_analysis_id' => $criteriaAnalysisId,
                'criteria_id'          => $criteria->id,
            ], $data);
        }
    }

    // nilai random konsistensi
    private function prepareAnalysisData($criteriaAnalysis)
    {
        $criteriaAnalysis->load('details', 'details.firstCriteria', 'details.secondCriteria', 'priorityValues', 'priorityValues.criteria');
        $totalPerCriteria = $this->_getTotalSumPerCriteria($criteriaAnalysis->id, CriteriaAnalysisDetail::getSelectedCriterias($criteriaAnalysis->id));
        // Nilai Random Konsistensi
        $ruleRC = [
            1  => 0.0,
            2  => 0.0,
            3  => 0.58,
            4  => 0.90,
            5  => 1.12,
            6  => 1.24,
            7  => 1.32,
            8  => 1.41,
            9  => 1.45,
            10 => 1.49,
            11 => 1.51,
            12 => 1.48,
            13 => 1.56,
            14 => 1.57,
            15 => 1.59,
        ];
        $criteriaAnalysis->unsetRelation('details');
        return ['totalSums' => $totalPerCriteria,'ruleRC' => $ruleRC,];
    }

    private function _finalRanking($bobots, $normalizations)
    {
        foreach ($normalizations as $keyNorm => $normal) {
            foreach ($normal['results'] as $keyVal => $value) {
                $importanceVal = $bobots[$keyVal]->value;
                // Operasi penjumlahan dari perkalian matriks ternormalisasi dan prioritas
                $result = $importanceVal * $value;
                if (array_key_exists('rank_result', $normalizations[$keyNorm])) {
                    $normalizations[$keyNorm]['rank_result'] += $result;
                } else {
                    $normalizations[$keyNorm]['rank_result'] = $result;
                }
            }
        }
        usort($normalizations, function ($a, $b) {
            return $b['rank_result'] <=> $a['rank_result'];
        });
        return $normalizations;
    }

    public function result(CriteriaAnalysis $criteriaAnalysis)
    {
        $criteriaAnalysis->load('priorityValues');
        $criterias          = CriteriaAnalysisDetail::getSelectedCriterias($criteriaAnalysis->id);
        $criteriaIds        = $criterias->pluck('id');
        $dividers           = Alternative::getDividerByCriteria($criterias);
        $criterias          = Criteria::all();
        $numberOfCriterias  = count($criterias);
        $alternatives       = Alternative::all();
        $alternative1s      = Alternative::getAlternativesByCriteria($criteriaIds);
        $normalizations     = $this->_hitungNormalisasi($dividers, $alternative1s);
        $data               = $this->prepareAnalysisData($criteriaAnalysis);
        $isAbleToRank       = $this->checkIfAbleToRank();
        try {
            $ranking = $this->_finalRanking($criteriaAnalysis->bobots, $normalizations);
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('pages.admin.ahp.result', [
            'title'             => 'Perhitungan AHP',
            'criteriaAnalysis'  => $criteriaAnalysis,
            'criteria_analysis' => $criteriaAnalysis,
            'dividers'          => $dividers,
            'totalSums'         => $data['totalSums'],
            'ruleRC'            => $data['ruleRC'],
            'isAbleToRank'      => $isAbleToRank,
            'numberOfCriterias' => $numberOfCriterias,
            'alternatives'      => $alternatives,
            'criterias'         => $criterias,
            'normalizations'    => $normalizations,
        ]);
    }

    // detail perhitungan
    public function detail(CriteriaAnalysis $criteriaAnalysis)
    {
        $criteriaAnalysis->load('priorityValues');
        $criterias          = CriteriaAnalysisDetail::getSelectedCriterias($criteriaAnalysis->id);
        $criteriaIds        = $criterias->pluck('id');
        $dividers           = Alternative::getDividerByCriteria($criterias);
        $criterias          = Criteria::all();
        $numberOfCriterias  = count($criterias);
        $alternatives       = Alternative::all();
        $alternative1s      = Alternative::getAlternativesByCriteria($criteriaIds);
        $normalizations     = $this->_hitungNormalisasi($dividers, $alternative1s);
        $data               = $this->prepareAnalysisData($criteriaAnalysis);
        $isAbleToRank       = $this->checkIfAbleToRank();
        try {
            $ranking = $this->_finalRanking($criteriaAnalysis->bobots, $normalizations);
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('pages.admin.ahp.detail', [
            'title'             => 'Detail Perhitungan AHP',
            'criteriaAnalysis'  => $criteriaAnalysis,
            'criteria_analysis' => $criteriaAnalysis,
            'totalSums'         => $data['totalSums'],
            'ruleRC'            => $data['ruleRC'],
            'isAbleToRank'      => $isAbleToRank,
            'dividers'          => $dividers,
            'numberOfCriterias' => $numberOfCriterias,
            'alternatives'      => $alternatives,
            'criterias'         => $criterias,
            'normalizations'    => $normalizations,
        ]);
    }
}