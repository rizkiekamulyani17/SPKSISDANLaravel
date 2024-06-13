<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CriteriaPerbadinganRequest;
use App\Http\Requests\Admin\BobotRequest;
use App\Models\Alternative;
use App\Models\Bobot;
use App\Models\Criteria;
use App\Models\CriteriaAnalysis;
use App\Models\CriteriaAnalysisDetail;
use App\Models\Kelas;
use App\Models\PriorityValue;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;

class FreeController extends Controller
{
    protected $limit   = 10;
    protected $field1s = array('siswas.*');
    protected $field2s = array('siswas.*', 'kelas.id as kelasId');
    protected $field3s = array('criterias.*');

    public function index()
    {
        $siswas = Siswa::where('validasi', '=', '2')->orderby('nama_siswa')->get();
        return view('pages.free.dashboard', [
            'title'     => 'Dashboard',
            'siswa'    => Siswa::count(),
            'criterias' => Criteria::count(),
            'kelas'     => Kelas::count(),
            'users'     => User::count(),
            'siswas'   => $siswas,
        ]);
    }

    public function kriteria(Request $request)
    {
        // menampilkan data kriteria
        $criterias = Criteria::orderby('id');
        // filter search
        if (request('search')) {
            $criterias = Criteria::where('nama_kriteria', 'LIKE', '%' . request('search') . '%')
                ->orWhere('slug', 'LIKE', '%' . request('search') . '%')
                ->orWhere('kategori', 'LIKE', '%' . request('search') . '%')
                ->orWhere('skala1', 'LIKE', '%' . request('search') . '%')
                ->orWhere('skala2', 'LIKE', '%' . request('search') . '%')
                ->orWhere('skala3', 'LIKE', '%' . request('search') . '%')
                ->orWhere('skala4', 'LIKE', '%' . request('search') . '%')
                ->orWhere('skala5', 'LIKE', '%' . request('search') . '%')
                ->orWhere('skala6', 'LIKE', '%' . request('search') . '%');
        }
        // Get value halaman yang dipilih dari dropdown
        $page = $request->query('page', 1);
        // Tetapkan opsi dropdown halaman yang diinginkan
        $perPageOptions = [5, 10, 15, 20, 25];
        // Get value halaman yang dipilih menggunaakan the query parameters
        $perPage = $request->query('perPage', $perPageOptions[1]);
        // Paginasi hasil dengan halaman dan dropdown yang dipilih
        $criterias = $criterias->paginate($perPage, $this->field3s, 'page', $page);
        return view('pages.free.kriteria', [
            'title'          => 'Data Kriteria',
            'criterias'      => $criterias,
            'perPageOptions' => $perPageOptions,
            'perPage'        => $perPage
        ]);
    }

    public function siswa(Request $request)
    {
        $siswas = Siswa::where('validasi', '=', '2')->orderby('nama_siswa');
        if (request('search')) {
            $siswas->join('kelas', 'kelas.id', '=', 'siswas.kelas_id')
                ->where('siswas.nama_siswa', 'LIKE', '%' . request('search') . '%')
                ->orWhere('siswas.biaya', 'LIKE', '%' . request('search') . '%')
                ->orWhere('kelas.kelas_name', 'LIKE', '%' . request('search') . '%')
                ->get();
        }
        $page = $request->query('page', 1);
        $perPageOptions = [5, 10, 15, 20, 25];
        $perPage = $request->query('perPage', $perPageOptions[1]);
        $siswas = $siswas->paginate($perPage, $this->field1s, 'page', $page);
        return view('pages.free.siswa', [
            'title'          => 'Data  Siswa',
            'siswas'        => $siswas,
            'perPageOptions' => $perPageOptions,
            'perPage'        => $perPage
        ]);
    }

    public function kelas()
    {
        // mengurutkan
        $kelas = Kelas::orderby('kelas_name')->get();
        return view('pages.free.kelas', [
            'title'   => 'Data Kelas ',
            'siswas' => '',
            'kelases' => $kelas
        ]);
    }

    public function kelasSlug(Kelas $kelas)
    {
        return view('pages.free.kelasSlug', [
            'title'   => $kelas->kelas_name,
            'siswas' => $kelas->siswas,
            'active'  => 'kelas',
            'kelas'   => $kelas->kelas_name,
        ]);
    }

    public function alternatif(Request $request)
    {
        // if (auth()->user()->level === 'ADMIN' || auth()->user()->level === 'USER') {
        //     $alternatives = Alternative::with('user')->get();
        // }
        $usedIds    = Alternative::select('siswa_id')->distinct()->get();
        $usedIdsFix = [];

        foreach ($usedIds as $usedId) {
            array_push($usedIdsFix, $usedId->siswa_id);
        }
        $alternatives = Siswa::join('kelas', 'kelas.id', '=', 'siswas.kelas_id')
            ->whereIn('siswas.id', $usedIdsFix)
            ->orderBy('siswas.nama_siswa')
            ->with('alternatives');
        if (request('search')) {
            $alternatives = Siswa::join('kelas', 'kelas.id', '=', 'siswas.kelas_id')
                ->where('siswas.nama_siswa', 'LIKE', '%' . request('search') . '%')
                ->orWhere('kelas.kelas_name', 'LIKE', '%' . request('search') . '%')
                ->whereIn('siswas.id', $usedIdsFix)
                ->with('alternatives');
        }
        $siswasList = Siswa::join('kelas', 'kelas.id', '=', 'siswas.kelas_id')
            ->whereNotIn('siswas.id', $usedIdsFix)
            ->orderBy('kelas.id')
            ->orderBy('siswas.nama_siswa', 'ASC')
            ->get(['siswas.*', 'kelas.id as kelasId'])
            ->groupBy('kelas.kelas_name');
        $page = $request->query('page', 1);
        $perPageOptions = [5, 10, 15, 20, 25];
        $perPage = $request->query('perPage', $perPageOptions[1]);
        $alternatives = $alternatives->paginate($perPage, $this->field2s, 'page', $page);
        return view('pages.free.alternatif', [
            'title'          => 'Data Alternatif',
            'alternatives'   => $alternatives,
            'criterias'      => Criteria::all(),
            'siswa_list'    => $siswasList,
            'perPageOptions' => $perPageOptions,
            'perPage'        => $perPage
        ]);
    }

    public function awal()
    {
        $comparisons = CriteriaAnalysis::with('user')->with(['details' => function ($query) {
            $query->join('criterias', 'criteria_analysis_details.criteria_id_second', '=', 'criterias.id')
            ->select('criteria_analysis_details.*', 'criterias.nama_kriteria as criteria_name')
            ->orderBy('criterias.id');
        }])
        ->get();
        $criteriaAnalysis = CriteriaAnalysis::with('user')->with(['details' => function ($query) {
            $query->join('criterias', 'criteria_analysis_details.criteria_id_second', '=', 'criterias.id')
                ->select('criteria_analysis_details.*', 'criterias.nama_kriteria as criteria_name')
                ->orderBy('criterias.id');
        }])->get();
        $criterias = Criteria::all();
        return view('pages.free.perhitungan', [
            'title'             => 'Metode SPK',
            'comparisons'       => $comparisons,
            'criterias'         => $criterias,
            'criteria_analysis' => $criteriaAnalysis,
        ]);
    }

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

    private function _finalRanking($priorityValues, $normalizations)
    {
        foreach ($normalizations as $keyNorm => $normal) {
            foreach ($normal['results'] as $keyVal => $value) {
                $importanceVal = $priorityValues[$keyVal]->value;
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
                // nilai prioritas sementara
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
            $bobot = [
                'criteria_analysis_id' => $criteriaAnalysisId,
                'criteria_id'          => $criteria->id,
                'value'                => floatval(0),
            ];
            // insert or create jika tidak ada
            PriorityValue::updateOrCreate([
                'criteria_analysis_id' => $criteriaAnalysisId,
                'criteria_id'          => $criteria->id,
            ], $data);
            Bobot::updateOrCreate([
                'criteria_analysis_id' => $criteriaAnalysisId,
                'criteria_id'          => $criteria->id,
            ], $bobot);
        }
    }

    public function resultKombinasi(CriteriaAnalysis $criteriaAnalysis)
    {
        $data           = $this->prepareAnalysisData($criteriaAnalysis);
        $isAbleToRank   = $this->checkIfAbleToRank();

        $criterias      = CriteriaAnalysisDetail::getSelectedCriterias($criteriaAnalysis->id);
        $criteriaIds    = $criterias->pluck('id');
        $alternatives   = Alternative::getAlternativesByCriteria($criteriaIds);
        $dividers       = Alternative::getDividerByCriteria($criterias);
        $normalizations = $this->_hitungNormalisasi($dividers, $alternatives);
        try {
            $ranking    = $this->_finalRanking($criteriaAnalysis->priorityValues, $normalizations);
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('pages.free.kombinasi', [
            'title'             => 'Perhitungan Kombinasi',
            'criteria_analysis' => $criteriaAnalysis,
            'totalSums'         => $data['totalSums'],
            'ruleRC'            => $data['ruleRC'],
            'isAbleToRank'      => $isAbleToRank,
            'dividers'          => $dividers,
            'criteriaAnalysis'  => $criteriaAnalysis,
            'criteria_analysis' => $criteriaAnalysis,
            'dividers'          => $dividers,
            'criterias'         => Criteria::all(),
            'normalizations'    => $normalizations,
            'ranks'             => $ranking,
        ]);
    }

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

    // check jika ada kriteria
    private function checkIfAbleToRank()
    {
        $availableCriterias = Criteria::all()->pluck('id');
        return Alternative::checkAlternativeByCriterias($availableCriterias);
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
                'nama_kriteria' => $criteria->nama_kriteria,
                'totalSum'      => floatval($totalPerCriteria)
            ];
            array_push($result, $data);
        }
        return $result;
    }

    // detail perhitungan
    public function detailKombinasi(CriteriaAnalysis $criteriaAnalysis)
    {
        $criteriaAnalysis->load('priorityValues');
        $data           = $this->prepareAnalysisData($criteriaAnalysis);
        $isAbleToRank   = $this->checkIfAbleToRank();

        $criterias      = CriteriaAnalysisDetail::getSelectedCriterias($criteriaAnalysis->id);
        $criteriaIds    = $criterias->pluck('id');
        $alternatives   = Alternative::getAlternativesByCriteria($criteriaIds);
        $dividers       = Alternative::getDividerByCriteria($criterias);
        $normalizations = $this->_hitungNormalisasi($dividers, $alternatives);
        try {
            $ranking    = $this->_finalRanking($criteriaAnalysis->priorityValues, $normalizations);
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('pages.free.kombinasiDetail', [
            'title'             => 'Detail Perhitungan Kombinasi',
            'criteria_analysis' => $criteriaAnalysis,
            'totalSums'         => $data['totalSums'],
            'ruleRC'            => $data['ruleRC'],
            'isAbleToRank'      => $isAbleToRank,
            'criteriaAnalysis'  => $criteriaAnalysis,
            'dividers'          => $dividers,
            'criterias'         => Criteria::all(),
            'normalizations'    => $normalizations,
            'ranks'             => $ranking,
            'ranking'           => $ranking,
        ]);
    }

    public function resultAHP(CriteriaAnalysis $criteriaAnalysis)
    {
        $criteriaAnalysis->load('priorityValues');
        $criterias          = CriteriaAnalysisDetail::getSelectedCriterias($criteriaAnalysis->id);
        $criteriaIds        = $criterias->pluck('id');
        $dividers           = Alternative::getDividerByCriteria($criterias);
        $criterias          = Criteria::all();
        $numberOfCriterias  = count($criterias);
        $alternatives       = Alternative::all();
        $alternative1s       = Alternative::getAlternativesByCriteria($criteriaIds);
        $normalizations     = $this->_hitungNormalisasi($dividers, $alternative1s);
        $data = $this->prepareAnalysisData($criteriaAnalysis);
        $isAbleToRank = $this->checkIfAbleToRank();
        try {
            $ranking    = $this->_finalRanking($criteriaAnalysis->bobots, $normalizations);
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('pages.free.ahp', [
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

    public function detailAHP(CriteriaAnalysis $criteriaAnalysis)
    {
        $data = $this->prepareAnalysisData($criteriaAnalysis);
        $isAbleToRank = $this->checkIfAbleToRank();
        $criteriaAnalysis->load('priorityValues');
        $criterias          = CriteriaAnalysisDetail::getSelectedCriterias($criteriaAnalysis->id);
        $criteriaIds        = $criterias->pluck('id');
        $dividers           = Alternative::getDividerByCriteria($criterias);
        $criterias          = Criteria::all();
        $numberOfCriterias  = count($criterias);
        $alternatives       = Alternative::all();
        $alternative1s      = Alternative::getAlternativesByCriteria($criteriaIds);
        $normalizations     = $this->_hitungNormalisasi($dividers, $alternative1s);
        try {
            $ranking    = $this->_finalRanking($criteriaAnalysis->bobots, $normalizations);
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('pages.free.ahpDetail', [
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

    public function resultSAW(CriteriaAnalysis $criteriaAnalysis)
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
        return view('pages.free.saw', [
            'title'            => 'Perhitungan SAW',
            'dividers'         => $dividers,
            'normalizations'   => $normalizations,
            'criteriaAnalysis' => $criteriaAnalysis,
            'criterias'        => Criteria::all(),
            'ranks'            => $ranking
        ]);
    }

    public function detailSAW(CriteriaAnalysis $criteriaAnalysis)
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
        return view('pages.free.sawDetail', [
            'criteriaAnalysis' => $criteriaAnalysis,
            'dividers'         => $dividers,
            'normalizations'   => $normalizations,
            'ranking'          => $ranking,
            'title'            => $title
        ]);
    }
}