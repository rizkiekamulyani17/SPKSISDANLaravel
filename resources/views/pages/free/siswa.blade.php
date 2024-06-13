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
            {{-- datatable --}}
            <div class="card mb-4">
                <div class="card-body table-responsive">
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
                        <form action="{{ route('free.siswa') }}" method="GET" class="ms-auto float-end">
                            <div class="input-group mb-3">
                                <input type="text" name="search" id="myInput" class="form-control"
                                    placeholder="Search..." value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
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
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-danger text-center p-4">
                                        <h4>Belum ada data Data Siswa</h4>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
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