@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4 border-bottom">
        <h1 class="mt-4 h2">{{ $title }}</h1>

        <form class="col-lg-8 contianer-fluid px-4 mt-3" method="POST" action="{{ route('kelas.index') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="kelas_name" class="form-label">Kelas</label>
                <input type="text" id="kelas_name" name="kelas_name"
                    class="form-control @error('kelas_name') is-invalid @enderror" value="{{ old('kelas_name') }}" autofocus
                    required placeholder="Masukkan Siswa">
                @error('kelas_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" id="keterangan" name="keterangan"
                    class="form-control @error('keterangan') is-invalid @enderror" value="{{ old('keterangan') }}" autofocus
                    required placeholder="Masukkan Keterangan">
                @error('keterangan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-3">Save</button>
            <a href="{{ route('kelas.index') }}" class="btn btn-danger mb-3">Cancel</a>
        </form>
    </div>
@endsection
