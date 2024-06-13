@extends('layouts.free')
@section('content')
<div class="container-fluid px-4">
    <div class="row align-items-center">
        <div class="col-sm-6 col-md-12">
            <h1 class="mt-4">{{ $title }}</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('free.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('free.perhitungan') }}">Metode SPK</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('perhitungan.ahp', $criteria_analysis->id) }}">
                        Perhitungan AHP
                    </a>
                </li>
                <li class="breadcrumb-item active">{{ $title }}</li>
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
                            {{ floatval($criteria_analysis->details[$startAt]->comparison_result) }}
                        </td>
                        @else
                        <td class="text-center {{ $bgYellow }}">
                            {{-- perhitungan --}}
                            @if ($bgYellow)
                            {{ 1 }} /
                            {{ round(floatval($criteria_analysis->details[$startAt]->comparison_value), 3) }}
                            =
                            @endif
                            {{-- hasil --}}
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
                            {{-- normalisasi --}}
                            {{ round(floatval($criteria_analysis->details[$startAt]->comparison_result), 3) }}
                            / {{ round($totalSums[$key]['totalSum'], 3) }} =
                            {{ round($res, 3) }}
                            {{-- row total --}}
                            @php($rowTotal += Str::substr($res, 0, 11))
                        </td>
                        @php($startAt++)
                        @endforeach
                        {{-- jumlah baris --}}
                        @php(array_push($rowTotals, $rowTotal))
                        <td class="text-center bg-success text-white">
                            {{ round($rowTotal, 3) }}
                        </td>
                        <td class="text-center bg-dark text-white">
                            {{-- Eigen Vector (EV) --}}
                            {{ round($rowTotal, 3) }} /
                            {{ $criteria_analysis->priorityValues->count() }} =
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
                            {{ $priorityValue->criteria->nama_kriteria }}
                        </th>
                        @foreach ($criteria_analysis->priorityValues as $key => $innerpriorityvalue)
                        <td class="text-center">
                            @php($res = floatval($criteria_analysis->details[$startAt]->comparison_result) *
                            $innerpriorityvalue->value)
                            {{-- hasil perkalian --}}
                            {{ round(floatval($criteria_analysis->details[$startAt]->comparison_result), 3) }}
                            * {{ round($innerpriorityvalue->value, 3) }} =
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
                    @php($hasil = [])
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
                            {{ round($total, 3) }} /
                            {{ round($criteria_analysis->priorityValues[$key]->value, 3) }} =
                            {{ round($res, 3) }}
                        </td>
                    </tr>
                    @endforeach
                    <tr class="align-middle">
                        <td class="text-center fw-bold bg-dark text-white" colspan="3">λmaks</td>
                        <td class="text-center fw-bold bg-dark text-white">
                            {{ round(array_sum($lambdaResult), 3) }} /
                            {{ count($lambdaResult) }}
                            =
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
                                    {{ round($lambdaMax, 3) }} - {{ count($lambdaResult) }}
                                    /
                                    {{ count($lambdaResult) }} - 1
                                    =
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
                                @if ($CR <= 0.1)
                                @php($txtClass='text-success fw-bold')
                                @endif
                                <td
                                    class="{{ $txtClass }}">
                                    {{ round($CI, 3) }} / {{ round($RC, 3) }} =
                                    {{ round($CR, 3) }}
                                    (Nilai Konsisten)
                                </td>
                            </tr>
                            <tr>
                                @if ($CR > 0.1)
                                <td class="text-danger" colspan="2">
                                    Nilai Rasio Konsistensi Melebihi <b>0.1</b> <br>
                                    Masukkan Kembali Nilai Perbandingan Kriteria
                                    <a href="{{ route('perbandingan.update', $criteria_analysis->id) }}"
                                        class="btn btn-danger mt-2">Masukkan Kembali Nilai Perbandingan</a>
                                </td>
                                @elseif(!$isAbleToRank)
                                <td class="text-danger" colspan="2">
                                    Admin Belum Memasukkan Alternatif Apapun <br>
                                    Harap Menunggu Operator Untuk Menginputkan Alternatif Sebelum Melihat
                                    Peringkat
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
                    $wisatas = \App\Models\Wisata::join('alternatives', 'wisatas.id', '=', 'alternatives.wisata_id')
                        ->join('criterias', 'alternatives.criteria_id', '=', 'criterias.id')
                        ->where('alternatives.criteria_id', $criteriaId)
                        ->whereIn('alternatives.wisata_id', $alternatives->pluck('wisata_id')->toArray())
                        ->orderBy('wisatas.nama_wisata')
                        ->get(['alternatives.*', 'wisatas.*', 'criterias.*']);
                    $min = $wisatas->min('alternative_value');
                    $max = $wisatas->max('alternative_value');
                    $sumMin = 0;
                    $sumMax = 0;
                    ?>
                    @foreach($wisatas as $wisata)
                        <?php
                        $sumMin += $min/$wisata->alternative_value;
                        $sumMax += $wisata->alternative_value/$max;
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
                            @foreach ($wisatas as $wisata)
                            <tr>
                                <td class="text-center">{{ $wisata->nama_wisata }}</td>
                                <td class="text-center">{{ $wisata->alternative_value }}</td>
                                @if($criterion->kategori === "COST")
                                    <td class="text-center">{{ round($min, 3) }} / {{ round($wisata->alternative_value, 3) }} = {{ round($min/$wisata->alternative_value, 3) }}</td>
                                @elseif($criterion->kategori === "BENEFIT")
                                    <td class="text-center">{{ round($wisata->alternative_value, 3) }} / {{ round($max, 3) }} = {{ round($wisata->alternative_value/$max, 3) }}</td>
                                @endif
                                @if($criterion->kategori === "COST")
                                    <td class="text-center">{{ round($min/$wisata->alternative_value, 3) }} / {{ round($sumMin, 3) }} = {{ round(($min/$wisata->alternative_value)/$sumMin, 3) }}</td>
                                @elseif($criterion->kategori === "BENEFIT")
                                    <td class="text-center">{{ round($wisata->alternative_value/$max, 3) }} / {{ round($sumMax, 3) }} = {{ round(($wisata->alternative_value/$max)/$sumMax, 3) }}</td>
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
                        <th scope="col" class="text-center">Jenis Wisata</th>
                        @foreach ($dividers as $divider)
                            <th scope="col">Hitung {{ $divider['nama_kriteria'] }}</th>
                        @endforeach
                        <th>Jumlah</th>
                        <th>Ranking</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php
                    $wisatas = \App\Models\Wisata::join('alternatives', 'wisatas.id', '=', 'alternatives.wisata_id')
                        ->join('criterias', 'alternatives.criteria_id', '=', 'criterias.id')
                        ->join('jenis', 'wisatas.jenis_id', '=', 'jenis.id')
                        ->where('alternatives.criteria_id', $criteriaId)
                        ->whereIn('alternatives.wisata_id', $alternatives->pluck('wisata_id')->toArray())
                        ->orderBy('wisatas.nama_wisata')
                        ->get(['alternatives.*', 'wisatas.*', 'criterias.*', 'jenis.*']);
                    ?>
                    @if (!empty($normalizations))
                        <?php
                        $nilaiBobotEvaluasi = [];
                        foreach ($normalizations as $normalisasi) {
                            $totalBobotEvaluasi = 0;
                            $nilaiKriteria = [];
                            foreach ($dividers as $key => $divider) {
                                $idCriteria = $divider['criteria_id'];
                                $nilais = \App\Models\Wisata::join('alternatives', 'wisatas.id', '=', 'alternatives.wisata_id')
                                    ->join('criterias', 'alternatives.criteria_id', '=', 'criterias.id')
                                    ->where('alternatives.criteria_id', $idCriteria)
                                    ->whereIn('alternatives.wisata_id', $alternatives->pluck('wisata_id')->toArray())
                                    ->orderBy('wisatas.nama_wisata')
                                    ->get(['alternatives.*', 'wisatas.*', 'criterias.*']);
            
                               // $bobots    = \App\Models\PriorityValue::where('criteria_id', $idCriteria)->get();
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
                                        $value               = ($val/$maxVal)/$sumMaxVal;
                                        $nilaiValue[$key]    = $value;
                                        $kali                = $innerpriorityvalue->value;
                                        $nilaiKali[$key]     = $kali;
                                        $bobotValue          = $value*$kali;
                                        $totalBobotEvaluasi += $bobotValue;
                                        $nilaiKriteria[$key] = $bobotValue;
                                    } elseif ($divider['kategori'] === 'COST' && $val != 0) {
                                        $value               = ($minVal/$val)/$sumMinVal;
                                        $nilaiValue[$key]    = $value;
                                        $kali                = $innerpriorityvalue->value;
                                        $nilaiKali[$key]     = $kali;
                                        $bobotValue          = $value*$kali;
                                        $totalBobotEvaluasi += $bobotValue;
                                        $nilaiKriteria[$key] = $bobotValue;
                                    }
                                }
                            }
                            $nilaiBobotEvaluasi[$normalisasi['wisata_name']] = [
                                'total_bobot'    => $totalBobotEvaluasi,
                                'nilai_kriteria' => $nilaiKriteria,
                                'jenis_name'     => $normalisasi['jenis_name'],
                                'nilaiValue'          => $nilaiValue,
                                'nilaiKali'           => $nilaiKali,
                            ];
                        }
                        arsort($nilaiBobotEvaluasi);
                        ?>
                        <?php $ranking = 1; ?>
                        @foreach ($nilaiBobotEvaluasi as $wisataName => $data)
                            <tr>
                                <td class="text-center">
                                    {{ $wisataName }}
                                </td>
                                <td class="text-center">
                                    {{ $data['jenis_name'] }}
                                </td>
                                @foreach ($dividers as $key => $divider)
                                    <td class="text-center">
                                        {{ round($data['nilaiValue'][$key], 3)}} * 
                                        {{ round($data['nilaiKali'][$key], 3)}} = 
                                        {{ round($data['nilai_kriteria'][$key], 3) }}
                                    </td>
                                @endforeach
                                <td class="text-center">
                                    @foreach ($dividers as $key => $divider)
                                        {{ round($data['nilai_kriteria'][$key], 3) }}
                                        @if (!$loop->last)
                                        +
                                        @endif
                                    @endforeach
                                    = {{ round($data['total_bobot'], 3) }}
                                </td>
                                <td class="text-center">{{ $ranking++ }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>            
        </div>
    </div>
</div>
@endsection