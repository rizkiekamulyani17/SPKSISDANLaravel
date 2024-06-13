<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="SPK Pemilihan Siswa Teladan" />
    <meta name="author" content="##" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('latarbelakang.jpg') }}" />
    <title>SPK | {{ $title }}</title>
    {{-- style --}}
    @include('includes.free.style')
</head>

<body class="sb-nav-fixed" style="font-family: 'Times New Roman', Times, serif">
    {{-- navbar --}}
    @include('includes.free.navbar')
    <div id="layoutSidenav">
        {{-- sidenav --}}
        @include('includes.free.sidenav')
        {{-- content --}}
        <div id="layoutSidenav_content">
            {{-- content --}}
            @yield('content')
            {{-- footer --}}
            @include('includes.free.footer')
        </div>
    </div>
    @include('includes.free.script')
</body>

</html>