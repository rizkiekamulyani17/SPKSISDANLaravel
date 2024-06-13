@extends('layouts.admin')
@section('content')
<div class="container-fluid px-4">
    <div class="row align-items-center">
        <div class="col-sm-6 col-md-12">
            <h1 class="mt-4">{{ $title }}</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('kombinasi.awal') }}">Metode SPK</a></li>
                <li class="breadcrumb-item active">{{ $title }}</li>
                <li class="breadcrumb-item">
                    <a href="{{ route('kombinasi.detail', $criteria_analysis->id) }}">
                       Perengkingan
                    </a>
                </li>
            </ol>
        </div>
    </div>
  
    {{-- Normalisasi --}}
    <div class="card mb-4">
        <div class="card-body table-responsive">
            <div class="d-sm-flex align-items-center">
                <div class="mb-4">
                    <h4 class="mb-0 text-gray-800"> Tabel Alternatif</h4>
                </div>
            </div>
            <table class="table table-bordered table-condensed">
                <tbody>
                <tr>
                <td scope="col" class="fw-bold text-center" style="width:11%">Kriteria</td>
                    @foreach ($dividers as $divider)
                    <td scope="col">  {{ $divider['nama_kriteria'] }}
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td scope="col" class="fw-bold text-center" style="width:11%">Kategori</td>
                        @foreach ($dividers as $divider)
                        <td class="text-center" scope="col">{{ $divider['kategori'] }}</td>
                        @endforeach
                    </tr>
                  
                    <tr>
                        <td scope="col" class="fw-bold text-center" style="width:11%">EV/Bobot</td>
                        @foreach ($criteriaAnalysis->priorityValues as $key => $innerpriorityvalue)
                        <td class="text-center">
                            {{ round($innerpriorityvalue->value, 3) }}
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            <table id="datatablesSimple" class="table table-bordered">
                <thead class="table-primary align-middle text-center">
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Nama Alternatif</th>
                        <th scope="col" class="text-center">Kelas </th>
                        @foreach ($dividers as $divider)
                        <th scope="col">{{ $divider['nama_kriteria'] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @if (!empty($normalizations))
                    @foreach ($normalizations as $normalisasi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-center">
                            {{ Str::ucfirst($normalisasi['siswa_name']) }}
                        </td>
                        <td class="text-center">
                            {{ $normalisasi['kelas_name'] }}
                        </td>
                        @foreach ($dividers as $key => $value)
                        @if (isset($normalisasi['results'][$key]))
                        <td class="text-center">
                            {{ round($normalisasi['results'][$key], 3) }}
                        </td>
                        @else
                        <td class="text-center">
                            Empty
                        </td>
                        @endif
                        @endforeach
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    {{-- Ranking --}}
    <div class="card mb-4">
        <div class="card-body table-responsive">
            <div class="d-sm-flex align-items-center">
                <div class="mb-4">
                    <h4 class="mb-0 text-gray-800"> Ranking</h4>
                </div>
            </div>
            <table id="datatablesSimple2" class="table table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Nama Alternatif</th>
                        <th scope="col">Kelas </th>
                        @foreach ($dividers as $divider)
                        <th scope="col">
                            Hitung {{ $divider['nama_kriteria'] }}
                        </th>
                        @endforeach
                        <th scope="col" class="text-center">Jumlah</th>
                        <th scope="col" class="text-center">Ranking</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($ranks))
                    @php($rankResult = [])
                    @php($hasilKali = [])
                    @foreach ($ranks as $rank)
                    <tr>
                        <td>
                            {{ $rank['siswa_name'] }}
                        </td>
                        <td>
                            {{ $rank['kelas_name'] }}
                        </td>
                        @foreach ($criteriaAnalysis->priorityValues as $key => $innerpriorityvalue)
                        @php($hasilNormalisasi = isset($rank['results'][$key]) ? $rank['results'][$key] : 0)
                        <td class="text-center">
                            @php($kali = $innerpriorityvalue->value * $hasilNormalisasi)
                            @php($res = substr($kali, 0, 11))
                            @php(array_push($hasilKali, $res))
                            {{ round($res, 3) }}
                        </td>
                        @endforeach
                        <td class="text-center">
                            {{ round($rank['rank_result'], 3) }}
                        </td>
                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection