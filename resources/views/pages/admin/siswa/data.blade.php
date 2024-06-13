@extends('layouts.admin')
@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-sm-6 col-md-12">
                <h1 class="mt-4">{{ $title }}</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>
        {{-- datatable --}}
        <div class="card mb-4">
            <div class="card-body">
                @can('admin')
                <div class="d-sm-flex align-items-center justify-content-between">
                    <a href="{{ route('siswa.create') }}" type="button" class="btn btn-primary mb-3"><i
                            class="fas fa-plus me-1"></i>Data Siswa
                    </a>
                </div>
                @endcan
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
                <div class="d-sm-flex align-items-center justify-content-between mb-3">
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
                    <form action="{{ route('siswa.index') }}" method="GET" class="ms-auto">
                        <div class="input-group mb-3">
                            <input type="text" name="search" id="myInput" class="form-control"
                                placeholder="Search..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-primary text-white align-middle text-center">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">NIS</th>
                                <th class="text-center">Nama Siswa</th>
                              
                                <th class="text-center">Kelas</th>
                                <th class="text-center">Jenis Kelamin</th>
                                <th class="text-center">Agama</th>
                                <th class="text-center">Alamat</th>
                                @can('admin')
                                <th class="text-center">Aksi</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @if ($siswas->count())
                                @foreach ($siswas as $siswa)
                                    <tr>
                                        <td scope="row" class="text-center">
                                            {{ ($siswas->currentpage() - 1) * $siswas->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td class="text-center">
                                            @if($siswa->nis == "")
                                            
                                            @else
                                            {{ Str::ucfirst($siswa->nis) }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($siswa->nama_siswa == "")
                                            
                                            @else
                                            {{ Str::ucfirst($siswa->nama_siswa) }}
                                            @endif
                                        </td>
                                       
                                        <td class="text-center">
                                            {{ $siswa->kelas->kelas_name ?? 'Tidak Punya Kelas' }}
                                        </td>
                                        @if($siswa->jenis_kelamin == "" || $siswa->jenis_kelamin == "-")
                                        <td class="text-center">-</td>
                                        @else
                                        <td>{{ $siswa->jenis_kelamin }}</td>
                                        @endif
                                        <td class="text-center">
                                            @if($siswa->agama == "")
                                            
                                            @else
                                            {{ Str::ucfirst($siswa->agama) }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($siswa->alamat == "")
                                            
                                            @else
                                            {{ Str::ucfirst($siswa->alamat) }}
                                            @endif
                                        </td>
                                        @can('admin')
                                        <td>
                                            <a href="{{ route('siswa.edit', $siswa->id) }}" class="badge bg-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button class="badge bg-danger border-0 btnDelete" data-object="Destinasia {{ $siswa->nama_siswa }}"><i class="fa-solid fa-trash-can"></i></button>
                                            </form>                                            
                                        </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="text-danger text-center p-4">
                                        <h4>Belum Ada Data Destinasi Wisata</h4>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                {{ $siswas->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</main>
<script>
    function submitForm() {
        var perPageSelect = document.getElementById('perPage');
        var perPageValue = perPageSelect.value;
        var currentPage = {{ $siswas->currentPage() }};
        var url = new URL(window.location.href);
        var params = new URLSearchParams(url.search);
        params.set('perPage', perPageValue);
        if (!params.has('page')) {
            params.set('page', currentPage);
        }
        url.search = params.toString();
        window.location.href = url.toString();
    }
</script>
@endsection