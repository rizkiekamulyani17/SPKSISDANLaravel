@extends('layouts.admin')
@section('content')
<div class="container-fluid px-4">
<h1 class="mt-4">Detail Kelas Siswa: {{ $kelas }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('kelas.index') }}">Data Kelas</a></li>
        <li class="breadcrumb-item active">{{ $title }}</li>
    </ol>
    {{-- datatable --}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Nis</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th> Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswas->where('validasi', '=', '2')->sortBy('nama_siswa') as $siswa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($siswa->nis && $siswa->nis != "-")
                                        {{ $siswa->nis }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($siswa->nama_siswa)
                                        {{ Str::ucfirst($siswa->nama_siswa) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($siswa->kelas_id && $siswa->kelas_id != "-")
                                        {{ $siswa->kelas_id }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($siswa->jenis_kelamin && $siswa->jenis_kelamin != "-")
                                        {{ $siswa->jenis_kelamin }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($siswa->agama && $siswa->agama != "-")
                                        {{ $siswa->agama }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($siswa->alamat && $siswa->alamat != "-")
                                        {{ $siswa->alamat }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection