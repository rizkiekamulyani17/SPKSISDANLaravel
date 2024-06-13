@extends('layouts.free')
@section('content')
<div class="container-fluid px-4">
    <div class="row align-items-center">
        <div class="col-sm-6 col-md-12">
            <h1 class="mt-4">{{ $title }}</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('free.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('free.perhitungan') }}">Metode SPK</a></li>
                <li class="breadcrumb-item active">{{ $title }}</li>
                <li class="breadcrumb-item">
                    <a href="{{ route('perhitungan.ahpDetail', $criteria_analysis->id) }}">
                        Detail Perhitungan AHP
                    </a>
                </li>
            </ol>
        </div>
    </div>
    {{-- Matriks Perbandingan dan Penjumlahan Kolom Kriteria --}}
    <div class="card mb-4">
        <div class="card-body table-responsive">
            <div class="d-sm-flex align-items-center">
                <div class="mb-4">
                    <h4 class="mb-0 text-gray-800">Matriks Perbandingan dan Penjumlahan Kolom Kriteria</h4>
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="bg-primary align-middle text-center">
                    <tr>
                        <th scope="col" class="text-white"><i>Kriteria</i></th>
                        @foreach ($criteria_analysis->priorityValues as $priorityValue)
                        <th scope="col">
                            {{ $priorityValue->criteria->nama_kriteria }}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @php($startAt = 0)
                    @foreach ($criteria_analysis->priorityValues as $priorityValue)
                    @php($bgYellow = 'bg-warning text-dark')
                    <tr>
                        <th scope="row" class="text-center bg-primary">
                            {{ $priorityValue->criteria->nama_kriteria }}
                        </th>
                        @foreach ($criteria_analysis->priorityValues as $priorityvalue)
                        @if (
                        $criteria_analysis->details[$startAt]->criteria_id_first ===
                        $criteria_analysis->details[$startAt]->criteria_id_second)
                        @php($bgYellow = '')
                        <td class="text-center bg-success text-white ">
                            {{ round(floatval($criteria_analysis->details[$startAt]->comparison_result), 3) }}
                        </td>
                        @else
                        <td class="text-center {{ $bgYellow }}">
                            {{ round(floatval($criteria_analysis->details[$startAt]->comparison_result), 3) }}
                        </td>
                        @endif
                        @php($startAt++)
                        @endforeach
                    </tr>
                    @endforeach
                    <th class="text-center bg-dark text-white">Jumlah</th>
                    @foreach ($totalSums as $total)
                    <td class="text-center bg-dark text-white">
                        {{ round($total['totalSum'], 3) }}
                    </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- Matriks Normalisasi Kriteria dan Eigen Vector (EV) --}}
    <div class="card mb-4">
        <div class="card-body table-responsive">
            <div class="d-sm-flex align-items-center">
                <div class="mb-4">
                    <h4 class="mb-0 text-gray-800">Matriks Normalisasi Kriteria dan Eigen Vector (EV)</h4>
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="table-primary align-middle text-center">
                    <tr>
                        <th scope="col" class="bg-primary text-white"><i>Kriteria</i></th>
                        @foreach ($criteria_analysis->priorityValues as $priorityValue)
                        <th scope="col" class="bg-primary">
                            {{ $priorityValue->criteria->nama_kriteria }}</th>
                        @endforeach
                        <th scope="col" class="text-center bg-success text-white">Jumlah</th>
                        <th scope="col" class="text-center bg-dark text-white">Eigen Vector (EV)</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @php($startAt = 0)
                    @php($rowTotals = [])
                    @foreach ($criteria_analysis->priorityValues as $priorityValue)
                    @php($rowTotal = 0)
                    @php($bgYellow = 'bg-warning text-dark')
                    <tr>
                        <th scope="row" class="bg-primary text-center">
                            {{ $priorityValue->criteria->nama_kriteria }}
                        </th>
                        @foreach ($criteria_analysis->priorityValues as $key => $priorityvalue)
                        <td class="text-center">
                            @php($res = floatval($criteria_analysis->details[$startAt]->comparison_result) /
                            $totalSums[$key]['totalSum'])
                            {{ round($res, 3) }}
                            @php($rowTotal += Str::substr($res, 0, 11))
                        </td>
                        @php($startAt++)
                        @endforeach
                        @php(array_push($rowTotals, $rowTotal))
                        <td class="text-center bg-success text-white">
                            {{ round($rowTotal, 3) }}
                        </td>
                        <td class="text-center bg-dark text-white">
                            {{ round($priorityValue->value, 3) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- Matriks Perkalian Setiap Elemen dengan Eigen Vector (EV) --}}
    <div class="card mb-4">
        <div class="card-body table-responsive">
            <div class="d-sm-flex align-items-center">
                <div class="mb-4">
                    <h4 class="mb-0 text-gray-800">Matriks Perkalian Setiap Elemen dengan Eigen Vector (EV)</h4>
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="table-primary align-middle text-center">
                    <tr>
                        <th scope="col" class="bg-primary text-white"><i>Kriteria</i></th>
                        @foreach ($criteria_analysis->priorityValues as $priorityValue)
                        <th scope="col" class="bg-primary">{{ $priorityValue->criteria->nama_kriteria }}</th>
                        @endforeach
                        <th scope="col" class="bg-dark text-white">Jumlah Baris</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @php($startAt = 0)
                    @php($rowTotals = [])
                    @foreach ($criteria_analysis->priorityValues as $priorityValue)
                    @php($rowTotal = 0)
                    <tr>
                        <th scope="row" class="bg-primary text-center">
                            {{ $priorityValue->criteria->nama_kriteria }}</th>
                        @foreach ($criteria_analysis->priorityValues as $key => $innerpriorityvalue)
                        <td class="text-center">
                            @php($res = floatval($criteria_analysis->details[$startAt]->comparison_result) *
                            $innerpriorityvalue->value)
                            {{-- hasil perkalian --}}
                            {{ round($res, 3) }}
                            {{-- row total --}}
                            @php($rowTotal += Str::substr($res, 0, 11))
                        </td>
                        @php($startAt++)
                        @endforeach
                        @php(array_push($rowTotals, $rowTotal))
                        <td class="text-center bg-dark text-white">
                            {{-- {{ $rowTotal }} --}}
                            {{ round($rowTotal, 3) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- Menentukan λmaks dan Rasio Konsistensi --}}
    <div class="card mb-4">
        <div class="card-body table-responsive">
            <div class="d-sm-flex align-items-center">
                <div class="mb-4">
                    <h4 class="mb-0 text-gray-800">Menentukan λmaks dan Rasio Konsistensi</h4>
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="bg-primary align-middle text-center">
                    <tr>
                        <th scope="col">Kriteria</th>
                        <th scope="col">Jumlah Baris</th>
                        <th scope="col">Eigen Vector (EV)</th>
                        <th scope="col">λ</th>
                    </tr>
                </thead>
                <tbody>
                    @php($lambdaMax = null)
                    @php($lambdaResult = [])
                    @foreach ($rowTotals as $key => $total)
                    <tr>
                        <td scope="row" class="text-center">
                            {{ $criteria_analysis->priorityValues[$key]->criteria->nama_kriteria }}
                        </td>
                        <td class="text-center">
                            {{ round($total, 3) }}
                        </td>
                        <td class="text-center">
                            {{ round($criteria_analysis->priorityValues[$key]->value, 3) }}
                        </td>
                        <td class="text-center">
                            @php($lambda = $total / $criteria_analysis->priorityValues[$key]->value)
                            @php($res = substr($lambda, 0, 11))
                            @php(array_push($lambdaResult, $res))
                            {{ round($res, 3) }}
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td class="text-center fw-bold bg-dark text-white" colspan="3">λmaks</td>
                        <td class="text-center fw-bold bg-dark text-white">
                            @php($lambdaMax = array_sum($lambdaResult) / count($lambdaResult))
                            {{ round($lambdaMax, 3) }}
                        </td>
                    </tr>
                </tbody>
            </table>
            {{-- Final Result --}}
            <div class="d-lg-flex justify-content-center">
                <div class="col-12 col-lg-6">
                    <table class="table table-bordered text-center">
                        <tbody>
                            <tr>
                                <th class="text-center" scope="row">Banyak Kriteria (n)</th>
                                <td>{{ $criteria_analysis->priorityValues->count() }}</td>
                            </tr>
                            <tr>
                                <th scope="row">λmaks</th>
                                <td>{{ round($lambdaMax, 3) }}</td>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">Consistency Index (CI)</th>
                                <td>
                                    @php($CI = ($lambdaMax - count($lambdaResult)) / (count($lambdaResult) - 1))
                                    {{ round($CI, 3) }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">Random Index (RI)</th>
                                <td>
                                    @php($RC = $ruleRC[$criteria_analysis->priorityValues->count()])
                                    {{ $RC }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">Consistency Ratio (CR)</th>
                                @php($CR = $RC != 0.0 ? $CI / $RC : 0.0)
                                @php($txtClass = 'text-danger fw-bold')
                                @if ($CR <= 0.1) @php($txtClass='text-success fw-bold' ) @endif <td
                                    class="{{ $txtClass }}">
                                    <span id="cr-value">{{ round($CR, 3) }}</span>
                                    (Nilai Konsisten)
                                    </td>
                            </tr>
                            <tr>
                                @if ($CR > 0.1)
                                <td class="text-danger" colspan="2">
                                    Nilai Rasio Konsistensi melebihi <b>0.1</b> <br>
                                    Masukkan kembali nilai perbandingan kriteria
                                    <a href="{{ route('kombinasi.update', $criteria_analysis->id) }}"
                                        class="btn btn-danger mt-2">Masukkan kembali Nilai Perbandingan</a>
                                </td>
                                @elseif(!$isAbleToRank)
                                <td class="text-danger" colspan="2">
                                    Operator belum memasukkan alternatif apapun <br>
                                    Harap menunggu operator untuk menginputkan alternatif sebelum melihat
                                    peringkat
                                </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Menentukan Eigen Vector Alternatif di Setiap Kriteria --}}
    <div class="card mb-4">
        <div class="card-body table-responsive">
            <div class="d-sm-flex align-items-center">
                <div class="mb-4">
                    <h4 class="mb-0 text-gray-800">Menentukan Eigen Vector Alternatif di Setiap Kriteria</h4>
                </div>
            </div>
            <div>
                @foreach($criterias as $criterion)
                    <?php
                    $criteriaId = $criterion->id;
                    $siswas = \App\Models\Siswa::join('alternatives', 'siswas.id', '=', 'alternatives.siswa_id')
                        ->join('criterias', 'alternatives.criteria_id', '=', 'criterias.id')
                        ->where('alternatives.criteria_id', $criteriaId)
                        ->whereIn('alternatives.siswa_id', $alternatives->pluck('siswa_id')->toArray())
                        ->orderBy('siswas.nama_siswa')
                        ->get(['alternatives.*', 'siswas.*', 'criterias.*']);
                    $min = $siswas->min('alternative_value');
                    $max = $siswas->max('alternative_value');
                    $sumMin = 0;
                    $sumMax = 0;
                    ?>
                    @foreach($siswas as $siswa)
                        <?php
                        $sumMin += $min/$siswa->alternative_value;
                        $sumMax += $siswa->alternative_value/$max;
                        ?>
                    @endforeach
                    <table class="table table-bordered">
                        <thead class="table-primary align-middle text-center">
                            <tr>
                                <th colspan="{{ count($alternatives) + 1 }}" class="text-center fw-bold bg-primary">
                                    {{ 'Eigen Vector Alternatif untuk Kriteria: ' . $criterion->nama_kriteria }}
                                </th>
                            </tr>
                            <tr>
                                <th class="bg-success">Alternatif</th>
                                <th class="bg-success">Nilai</th>
                                @if($criterion->kategori === "COST")
                                <th class="bg-success">Nilai MIN / Nilai</th>
                                @elseif($criterion->kategori === "BENEFIT")
                                <th class="bg-success">Nilai / Nilai MAX</th>
                                @endif
                                <th class="bg-success">Eigen Vector (EV)</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($siswas as $siswa)
                            <tr>
                                <td class="text-center">{{ $siswa->nama_siswa }}</td>
                                <td class="text-center">{{ $siswa->alternative_value }}</td>
                                @if($criterion->kategori === "COST")
                                    <td class="text-center">{{ round($min/$siswa->alternative_value, 3) }}</td>
                                @elseif($criterion->kategori === "BENEFIT")
                                    <td class="text-center">{{ round($siswa->alternative_value/$max, 3) }}</td>
                                @endif
                                @if($criterion->kategori === "COST")
                                    <td class="text-center">{{ round(($min/$siswa->alternative_value)/$sumMin, 3) }}</td>
                                @elseif($criterion->kategori === "BENEFIT")
                                    <td class="text-center">{{ round(($siswa->alternative_value/$max)/$sumMax, 3) }}</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
    {{-- Ranking --}}
    <div class="card mb-4">
        <div class="card-body table-responsive">
            
            <div class="d-sm-flex align-items-center">
                <div class="mb-4">
                    <h4 class="mb-0 text-gray-800">Ranking</h4>
                </div>
            </div>
            <table class="table table-bordered table-condensed">
                <tbody>
                    <tr>
                        <td scope="col" class="fw-bold text-center" style="width:11%">Kriteria</td>
                        @foreach ($dividers as $divider)
                        <td class="text-center" scope="col">{{ $divider['nama_kriteria'] }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td scope="col" class="fw-bold text-center" style="width:11%">EV/Bobot</td>
                        @foreach ($criteriaAnalysis->priorityValues as $key => $innerpriorityvalue)
                        <td class="text-center align-middle">
                            {{ round($innerpriorityvalue->value, 3) }}
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            <table id="datatablesSimple" class="table table-bordered">
                <thead class="bg-primary align-middle text-center text-white">
                    <tr>
                        <th scope="col" class="text-center">Nama Alternatif</th>
                        <th scope="col" class="text-center">Data Kelas</th>
                        @foreach ($dividers as $divider)
                            <th scope="col">Hitung {{ $divider['nama_kriteria'] }}</th>
                        @endforeach
                        <th>Jumlah</th>
                        <th>Ranking</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php
                    $siswas = \App\Models\Siswa::join('alternatives', 'siswas.id', '=', 'alternatives.siswa_id')
                        ->join('criterias', 'alternatives.criteria_id', '=', 'criterias.id')
                        ->join('kelas', 'siswas.kelas_id', '=', 'kelas.id')
                        ->where('alternatives.criteria_id', $criteriaId)
                        ->whereIn('alternatives.siswa_id', $alternatives->pluck('siswa_id')->toArray())
                        ->orderBy('siswas.nama_siswa')
                        ->get(['alternatives.*', 'siswas.*', 'criterias.*', 'kelas.*']);
                    ?>
                    @if (!empty($normalizations))
                        <?php
                        $nilaiBobotEvaluasi = [];
                        foreach ($normalizations as $normalisasi) {
                            $totalBobotEvaluasi = 0;
                            $nilaiKriteria = [];
                            foreach ($dividers as $key => $divider) {
                                $idCriteria = $divider['criteria_id'];
                                $nilais = \App\Models\Siswa::join('alternatives', 'siswas.id', '=', 'alternatives.siswa_id')
                                    ->join('criterias', 'alternatives.criteria_id', '=', 'criterias.id')
                                    ->where('alternatives.criteria_id', $idCriteria)
                                    ->whereIn('alternatives.siswa_id', $alternatives->pluck('siswa_id')->toArray())
                                    ->orderBy('siswas.nama_siswa')
                                    ->get(['alternatives.*', 'siswas.*', 'criterias.*']);
                                
                              $bobots    = \App\Models\PriorityValue::where('criteria_id', $idCriteria)->get();
                                //$innerpriorityvalue=$criteriaAnalysis->priorityValues;
                                $minVal    = $nilais->min('alternative_value');
                                $maxVal    = $nilais->max('alternative_value');
                                $sumMinVal = 0;
                                $sumMaxVal = 0;
            
                                foreach($nilais as $nilai) {
                                    $sumMinVal += $minVal/$nilai->alternative_value;
                                    $sumMaxVal += $nilai->alternative_value/$maxVal;
                                }
                                $val = isset($normalisasi['alternative_val'][$key]) ? $normalisasi['alternative_val'][$key] : null;
                                $totalResult = 0;
                                foreach ($bobots as $bobot) {
                                    
                                    if ($divider['kategori'] === 'BENEFIT' && $val != 0) {
                                        //$bobotValue = (($val/$maxVal)/$sumMaxVal)*$bobot->value;
                                         $bobotValue =(($val/$maxVal)/$sumMaxVal)* $innerpriorityvalue->value ;
                                      
                                        $totalBobotEvaluasi += $bobotValue;
                                        $nilaiKriteria[$key] = $bobotValue;
                                    } elseif ($divider['kategori'] === 'COST' && $val != 0) {
                                        $bobotValue = (($minVal/$val)/$sumMinVal)*$innerpriorityvalue->value;
                                        //$bobotValue = (($val/$maxVal)/$sumMaxVal)*$bobot->value;
                                        
                                        $totalBobotEvaluasi += $bobotValue;
                                        $nilaiKriteria[$key] = $bobotValue;
                                    }
                                }
                            }
                            $nilaiBobotEvaluasi[$normalisasi['siswa_name']] = [
                                'total_bobot'    => $totalBobotEvaluasi,
                                'nilai_kriteria' => $nilaiKriteria,
                                'kelas_name'     => $normalisasi['kelas_name'],
                            ];
                        }
                        arsort($nilaiBobotEvaluasi);
                        ?>
                        <?php $ranking = 1; ?>
                        @foreach ($nilaiBobotEvaluasi as $siswaName => $data)
                            <tr>
                                <td class="text-center">
                                    {{ $siswaName }}
                                </td>
                                <td class="text-center">
                                    {{ $data['kelas_name'] }}
                                </td>
                                @foreach ($dividers as $key => $divider)
                                    <td class="text-center">
                                        {{ round($data['nilai_kriteria'][$key], 3) }}
                                    </td>
                                @endforeach
                                <td class="text-center">{{ round($data['total_bobot'], 3) }}</td>
                                <td class="text-center">{{ $ranking++ }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>            
        </div>
    </div>
</div>



      
    

@php(session(["cr_value_{$criteria_analysis->id}" => round($CR, 3)]))
@endsection