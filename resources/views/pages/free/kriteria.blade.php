@extends('layouts.free')
@section('content')
<main>
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
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        {{-- datatable --}}
        <div class="card mb-4">
            <div class="card-body table-responsive">
                {{-- validation error file required --}}
                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                {{-- file request --}}
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="d-sm-flex align-items-center justify-content-between">
                    <div class="d-sm-flex align-items-center mb-3">
                        <select class="form-select me-3" id="perPage" name="perPage" onchange="submitForm()">
                            @foreach ($perPageOptions as $option)
                            <option value="{{ $option }}" {{ $option == $perPage ? 'selected' : '' }}>
                                {{ $option }}
                            </option>
                            @endforeach
                        </select>
                        <label class="form-label col-lg-6 col-sm-6 col-md-6" for="perPage">entries per page</label>
                    </div>
                    <form action="{{ route('free.kriteria') }}" method="GET" class="ms-auto float-end">
                        <div class="input-group mb-3">
                            <input type="text" name="search" id="myInput" class="form-control" placeholder="Search..."
                                value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <table id="datatablesSimple" class="table table-bordered">
                    <thead class="bg-primary align-middle text-center text-white">
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Nama Kriteria</th>
                            <th rowspan="2">Kategori</th>
                            <th colspan="6">Sub Kriteria</th>
                        </tr>
                        <tr>
                                <th>Skala 1</th>
                                <th>Skala 2</th>
                                <th>Skala 3</th>
                                <th>Skala 4</th>
                                <th>Skala 5</th>
                                <!-- <th>Skala 6</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @if ($criterias->count())
                        @foreach ($criterias as $criteria)
                        <tr>
                            <td class="text-center bg-primary text-white">{{ $loop->iteration }}</td>
                            <td class="text-center bg-warning">{{ $criteria->nama_kriteria }}</td>
                            <td class="text-center bg-warning">{{ Str::ucfirst(Str::lower($criteria->kategori)) }}</td>
                            <!-- <td class="text-center">{{ $criteria->skala1 }}</td> -->
                            <td class="text-center">{{ $criteria->skala2 }}</td>
                            <td class="text-center">{{ $criteria->skala3 }}</td>
                            <td class="text-center">{{ $criteria->skala4 }}</td>
                            <td class="text-center">{{ $criteria->skala5 }}</td>
                            <td class="text-center">{{ $criteria->skala6 }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5" class="text-danger text-center p-4">
                                <h4>Kriteria belum dibuat</h4>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                {{ $criterias->appends(request()->query())->links() }}
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <p>Kriteria yang telah ditentukan dibagi menjadi dua kategori, yaitu:</p>
                <ul>
                    <li><b>Benefit (Keuntungan):</b> Semakin tinggi nilai keuntungannya maka semakin tinggi peluang untuk dipilih.</li>
                    <li><b>Cost (Biaya):</b> Semakin tinggi nilai cost maka semakin rendah peluang untuk dipilih.</li>
                </ul>
            </div>
        </div>
    </div>
</main>
@endsection