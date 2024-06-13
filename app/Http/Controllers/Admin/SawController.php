<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\CriteriaAnalysis;
use App\Models\CriteriaAnalysisDetail;

class SawController extends Controller
{
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
        $criteriaAnalysis->load('bobots');
        $criterias      = CriteriaAnalysisDetail::getSelectedCriterias($criteriaAnalysis->id);
        $criteriaIds    = $criterias->pluck('id');
        $alternatives   = Alternative::getAlternativesByCriteria($criteriaIds);
        $dividers       = Alternative::getDividerByCriteria($criterias);
        $normalizations = $this->_hitungNormalisasi($dividers, $alternatives);
        try {
            $ranking    = $this->_finalRanking($criteriaAnalysis->bobots, $normalizations);
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('pages.admin.saw.result', [
            'title'            => 'Perhitungan SAW',
            'dividers'         => $dividers,
            'normalizations'   => $normalizations,
            'criteriaAnalysis' => $criteriaAnalysis,
            'criterias'        => Criteria::all(),
            'ranks'            => $ranking
        ]);
    }

    public function detail(CriteriaAnalysis $criteriaAnalysis)
    {
        $criterias      = CriteriaAnalysisDetail::getSelectedCriterias($criteriaAnalysis->id);
        $criteriaIds    = $criterias->pluck('id');
        $alternatives   = Alternative::getAlternativesByCriteria($criteriaIds);
        $dividers       = Alternative::getDividerByCriteria($criterias);
        $normalizations = $this->_hitungNormalisasi($dividers, $alternatives);
        try {
            $ranking    = $this->_finalRanking($criteriaAnalysis->bobots, $normalizations);
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        $title = 'Detail Perhitungan SAW';
        return view('pages.admin.saw.detail', [
            'criteriaAnalysis' => $criteriaAnalysis,
            'dividers'         => $dividers,
            'normalizations'   => $normalizations,
            'ranking'          => $ranking,
            'title'            => $title
        ]);
    }
}