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
        <div class="card">
            <div class="card-body">
                @can('admin')
                <a href="{{ route('kelas.create') }}" type="button" class="btn btn-primary mb-3">
                    <i class="fas fa-plus me-1"></i>
                     Data Kelas
                </a>
                @endcan
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-bordered">
                        <thead class="bg-primary align-middle text-center text-white">
                            <tr>
                                <th>No</th>
                                <th>Kelas/th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($kelases->count())
                            @foreach ($kelases as $kelas)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    {{ Str::ucfirst($kelas->kelas_name) }}
                                </td>
                                <td class="text-center">
                                    @if ($kelas->keterangan == "" || $kelas->keterangan == "-")
                                    -
                                    @else
                                    {{ $kelas->keterangan }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('kelas.siswas', $kelas->slug) }}" class="badge bg-primary">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    @can('admin')
                                    <a href="{{ route('kelas.edit', $kelas->id) }}" class="badge bg-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('kelas.destroy', $kelas->id) }}" method="POST"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="badge bg-danger border-0 btnDelClass"
                                            data-object="{{ $kelas->kelas_name }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4" class="text-danger text-center p-4">
                                    <h4>Belum ada data Kelas</h4>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection