@extends('layouts.free')
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
           
            <h4 class="text-center">
                <p style="font-family: 'Times New Roman', Times, serif; font-size: 30px">SELAMAT DATANG DI</p>
                <i style="font-family: 'Courier New', Courier, monospace">Sistem Pendukung Keputusan Pemilihan Siswa Teladan (SISDAN)</i>
        </h4>
    
        <?php
        }else{
            ?>
                <div class="container d-flex justify-content-center align-items-center text-center position-relative">
                <!-- <img src="{{ url('frontend/images/Balai_Kota_Malang.jpg') }}" style="height: 4cm; width: 6cm"/>&nbsp;&nbsp; -->
                <h4>
                    <p style="font-family: 'Times New Roman', Times, serif; font-size: 45px">SELAMAT DATANG DI</p>
                    <i style="font-family: 'Courier New', Courier, monospace">Sistem Pendukung Keputusan Pemilihan Siswa Teladan (SISDAN)</i>
                </h4>
            </div>
            
            <?php
        }?>
    </div>
</main>
@endsection