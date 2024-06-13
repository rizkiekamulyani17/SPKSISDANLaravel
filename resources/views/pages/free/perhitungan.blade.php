@extends('layouts.free')
@section('content')
<div class="container-fluid px-4">
    <div class="row align-items-center">
        <div class="col-sm-6 col-md-12">
            <h1 class="mt-4">{{ $title }}</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('free.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </div>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <table id="datatablesSimple" class="table table-bordered">
                <thead class="bg-primary text-white align-middle text-center">
                    <tr>
                        <th>No</th>
                        <th>Kriteria</th>
                        <th>Jenis Metode</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($comparisons->count())
                    @foreach ($comparisons as $comparison)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            @foreach ($comparison->details->unique('criteria_id_second') as $key => $detail)
                            {{ $detail->criteria_name }}
                            @if (!$loop->last)
                            ,
                            @endif
                            @endforeach
                        </td>
                        <td>
                            <!-- <a href="{{ route('perhitungan.kombinasi', $comparison->id) }}"
                                class="badge bg-success text-decoration-none">
                                <i class="fa-solid fa-eye"></i>
                                Perhitungan Kombinasi
                            </a> -->
                            <a href="{{ route('perhitungan.ahp', $comparison->id) }}" class="badge bg-success text-decoration-none">
                                <i class="fa-solid fa-eye"></i>
                                Perhitungan AHP
                            </a>
                            <!-- <a href="{{ route('perhitungan.saw', $comparison->id) }}" class="badge bg-success text-decoration-none">
                                <i class="fa-solid fa-eye"></i>
                                Perhitungan SAW
                            </a> -->
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="4" class="text-danger text-center p-4">
                            <h4>Belum Ada Data Untuk Perbandingan Kriteria</h4>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Choose Criteria -->
    <div class="modal fade" id="modalChoose" tabindex="-1" aria-labelledby="modalChooseLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalChooseLabel">Pilih Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kombinasi.index') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center" colspan="2">Nama Kriteria</th>
                                    <th>Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($criterias->count())
                                @foreach ($criterias as $criteria)
                                <tr>
                                    <th scope="row" class="text-center">
                                        <input type="checkbox" value="{{ $criteria->id }}" name="criteria_id[]">
                                    </th>
                                    <td>{{ $criteria->nama_kriteria }}</td>
                                    <td>{{ Str::ucfirst(Str::lower($criteria->kategori)) }}
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class="text-center text-danger" colspan="4">Tidak Ditemukan Kriteria</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection