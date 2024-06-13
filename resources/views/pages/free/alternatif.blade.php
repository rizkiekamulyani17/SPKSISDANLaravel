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
        {{-- datatable --}}
        <div class="card mb-4">
            <div class="card-body table-responsive">
                <div class="d-sm-flex align-items-center">
                </div>
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
                    <form action="{{ route('free.alternatif') }}" method="GET" class="ms-auto float-end">
                        <div class="input-group mb-3">
                            <input type="text" name="search" id="myInput" class="form-control" placeholder="Search..."
                                value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered">
                    <thead class="bg-primary align-middle text-center text-white">
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Nama Alternatif</th>
                            <th rowspan="2">Kelas</th>
                            <th colspan="{{ $criterias->count() }}">Kriteria</th>
                           
                        </tr>
                        <tr>
                            @if ($criterias->count())
                            @foreach ($criterias as $criteria)
                            <th>{{ $criteria->nama_kriteria }}</th>
                            @endforeach
                            @else
                            <th>Data Kriteria Tidak Ditemukan</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="myTable">
                        @if ($alternatives->count())
                        @foreach ($alternatives as $alternative)
                        <tr>
                            <td scope="row" class="text-center">
                                {{ ($alternatives->currentpage() - 1) * $alternatives->perpage() + $loop->index + 1 }}
                            </td>
                            <td class="text-center">
                                {{ Str::ucfirst($alternative->nama_siswa) }}
                            </td>
                            <td class="text-center">
                                {{ $alternative->kelas->kelas_name }}
                            </td>
                            @foreach ($criterias as $key => $criteria)
                            @if (isset($alternative->alternatives[$key]))
                            <td class="text-center">
                                {{ floatval($alternative->alternatives[$key]->alternative_value) }}
                            </td>
                            @else
                            <td class="text-center">
                                Empty
                            </td>
                            @endif
                            @endforeach
                            
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="{{ 5 + $criterias->count() }}" class="text-center text-danger">
                                Belum Ada Data
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                {{ $alternatives->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
    <!-- Add Alternative -->
    <div class="modal fade" id="addAlternativeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addAlternativeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAlternativeModalLabel">Tambah Alternatif</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('alternatif.index') }}" method="post">
                    <div class="modal-body">
                        <span class="mb-2">Catatan :</span>
                        <ul class="list-group mb-2">
                            <li class="list-group-item bg-success text-white">
                                Nilai minimum 0 dan maximum 100
                            </li>
                            <li class="list-group-item bg-success text-white">
                                Gunakan (.) jika memasukkan nilai desimal
                            </li>
                        </ul>
                        @csrf
                        <div class="my-2">
                            <label for="siswa_id" class="form-label">Daftar Siswa</label>
                            <select class="form-select @error('siswa_id') 'is-invalid' : ''  @enderror" id="siswa_id"
                                name="siswa_id" required>
                                <option disabled selected value="">--Pilih Siswa--</option>
                                @if ($siswa_list->count())
                                @foreach ($siswa_list as $kelas => $siswas)
                                <optgroup label="Destinasi {{ $kelas }}: {{ $siswas->count() }}">
                                    @foreach ($siswas as $siswa)
                                    <option value="{{ $siswa->id }} {{ $siswa->kelasId }}">
                                        {{ $siswa->nama_siswa }} - {{ $siswa->kelas->kelas_name }}
                                    </option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                                @else
                                <option disabled selected>--TIDAK ADA DATA--</option>
                                @endif
                            </select>
                            @error('siswa_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        {{-- Masukkan Nilai Kriteria --}}
                        @if ($criterias->count())
                        @foreach ($criterias as $key => $criteria)
                        <input type="hidden" name="criteria_id[]" value="{{ $criteria->id }}">
                        <div class="my-2">
                            <label for="{{ str_replace(' ', '', $criteria->nama_kriteria) }}" class="form-label">
                                Nilai <b> {{ $criteria->nama_kriteria }} </b>
                            </label>
                            <input type="text" id="{{ str_replace(' ', '', $criteria->nama_kriteria) }}"
                                class="form-control @error('alternative_value') 'is-invalid' : '' @enderror"
                                name="alternative_value[]" placeholder="Masukkan Nilai"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57)|| event.charCode == 46)"
                                maxlength="5" autocomplete="off" required>
                            @error('alternative_value')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="{{ $criterias->count() ? 'submit' : 'button' }}"
                            class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function submitForm() {
            var perPageSelect = document.getElementById('perPage');
            var perPageValue = perPageSelect.value;
            var currentPage = {{ $alternatives->currentPage() }};
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