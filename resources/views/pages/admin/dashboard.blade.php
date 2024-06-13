@extends('layouts.admin')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
    <div class="container-fluid px-4">
        <?php
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Android') !== false || strpos($userAgent, 'iPhone') !== false || strpos($userAgent, 'iPad') !== false) {
        ?>
            <!-- <center><img src="{{ url('frontend/images/Balai_Kota_Malang.jpg') }}" style="height: 4cm; width: 6cm"/></center> -->
            <br>
            <h4 class="text-center">
                <p style="font-family: 'Times New Roman', Times, serif; font-size: 30px">SELAMAT DATANG DI</p>
                <i style="font-family: 'Courier New', Courier, monospace">Sistem Pendukung Keputusan Pemilihan Siswa Teladan (SISDAN) </i>
            </h4>
            @can('admin')
            <hr style="border-width: 2px;">
            <!-- Content Row -->
            <div class="row d-flex justify-content-center align-items-center position-relative">
                <!-- Data Kelas -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <a style="text-decoration:none; color: #212529;" href="{{ route('siswa.index') }}">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-upcase mb-1">
                                            Data Siswa
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $siswa }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-map-marked-alt fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Criteria -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <a href="{{ route('kriteria.index') }}" style="text-decoration:none; color: #212529;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Kriteria
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $criterias }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-list-alt fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- data kelas -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <a href="{{ route('kelas.index') }}" style="text-decoration:none; color: #212529;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                           Data Kelas
                                        </div>
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $kelas }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-hiking fa-3x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Data User -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <a href="{{ route('users.index') }}" style="text-decoration:none; color: #212529;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Pengguna
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user-gear fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @elseif('user')
            <hr style="border-width: 2px;">
            <div class="slide-container">
                <div class="slide-content">
                    @foreach ($siswas as $siswa)
                    <div class="slide-item">
                        <div class="d-flex justify-content position-relative" style="max-width: 80%">
                            @if ($siswa->nama_siswa == "" || $siswa->nama_siswa == "-")
                            <!-- <img src="frontend/images/noimage.png" alt="Gambar" style="width: 4cm; height: 3cm"> -->
                            @else
                            <img src="{{ $siswa->nama_siswa}}" alt="Gambar" style="width: 4cm; height: 3cm">
                            @endif
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 24px; max-width: 40%; min-width: 40%">
                                {{ $siswa->nama_siswa }}
                            </p>
                        </div>
                        <br>
                        <h4 style="max-width: 80%">
                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 12px">
                                <strong>Keterangan:</strong>
                                <br>
                                {{ $siswa->keterangan }}
                            </p>
                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 12px">
                                <strong>Website Resmi:</strong> 
                                @if($siswa->situs == "" || $siswa->situs == "-")
                                -
                                @else
                                <a href="{{ $siswa->situs }}">Klik di Sini</a>
                                @endif
                            </p>
                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 12px">
                                <strong>Fasilitas:</strong>
                                <br>
                                {{ $siswa->fasilitas}}
                            </p>
                        </h4>
                    </div>
                    @endforeach
                </div>
            </div>
            @endcan
        <?php
        }else{
            ?>
                <div class="container d-flex justify-content-center align-items-center text-center position-relative">
                <!-- <img src="{{ url('') }}" style="height: 4cm; width: 6cm"/>&nbsp;&nbsp; -->
                <h4>
                    <p style="font-family: 'Times New Roman', Times, serif; font-size: 45px">SELAMAT DATANG DI</p>
                    <i style="font-family: 'Courier New', Courier, monospace">Sistem Pendukung Keputusan Pemilihan Siswa Teladan</i>
                </h4>
            </div>
            @can('admin')
            <hr style="border-width: 2px;">
            <!-- Content Row -->
            <div class="row d-flex justify-content-center align-items-center position-relative">
                <!-- data siswa -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <a style="text-decoration:none; color: #212529;" href="{{ route('siswa.index') }}">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Data Siswa
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $siswa }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-map-marked-alt fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Criteria -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <a href="{{ route('kriteria.index') }}" style="text-decoration:none; color: #212529;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Kriteria
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $criterias }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-list-alt fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Data Kelas  -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <a href="{{ route('kelas.index') }}" style="text-decoration:none; color: #212529;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Data Kelas
                                        </div>
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $kelas }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-hiking fa-3x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Data User -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <a href="{{ route('users.index') }}" style="text-decoration:none; color: #212529;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Pengguna
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user-gear fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @elseif('user')
            <hr style="border-width: 2px;">
            <div class="slide-container">
                <div class="slide-content">
                    @foreach ($siswas as $siswa)
                    <div class="slide-item">
                        <div class="container d-flex justify-content position-relative">
                            <!-- @if ($siswa->link_foto == "" || $siswa->link_foto == "-")
                            <img src="frontend/images/noimage.png" alt="Gambar" style="height: 4cm; width: 6cm">
                            @else
                            <img src="{{ $siswa->link_foto }}" alt="Gambar" style="height: 4cm; width: 6cm">
                            @endif
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                            <!-- <h4 style="max-width: 30%; min-width:30%">
                                <p style="font-family: 'Times New Roman', Times, serif; font-size: 24">{{ $siswa->nama_siswa}}</p>
                                <p style="font-family: 'Times New Roman', Times, serif; font-size: 12px">{{ $siswa->keterangan }}</p><br> -->
                                <!-- <p style="font-family: 'Times New Roman', Times, serif; font-size: 12px">
                                    Website Resmi: 
                                    @if($siswa->situs == "" || $siswa->situs == "-")
                                    -
                                    @else
                                    <a href="{{ $siswa->situs }}">Klik di Sini</a>
                                    @endif
                                </p> -->
                            </h4>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <!-- <h4 style="max-width: 30%; min-width:30%">
                                <p style="font-family: 'Times New Roman', Times, serif; font-size: 24">Fasilitas</p>
                                <p style="font-family: 'Times New Roman', Times, serif; font-size: 12px">{{ $siswa->fasilitas}}</p>
                            </h4> -->
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endcan
            <?php
        }?>
    </div>
</main>
@endsection