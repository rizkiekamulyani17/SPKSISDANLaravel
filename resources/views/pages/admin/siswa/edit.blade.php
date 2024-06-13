@extends('layouts.admin')
@section('content')
    <div class="container-fluid px-4 border-bottom">
        <h1 class="mt-4 h2">{{ $title }}</h1>
    </div>
    <form class="col-lg-8 contianer-fluid px-4 mt-3" method="POST" action="{{ route('siswa.update', $siswa->id) }}"
        enctype="multipart/form-data">
        @method('PUT')
        @csrf
        {{-- nis  siswa --}}
        <div class="mb-3">
            <label for="nis" class="form-label">NIS</label>
            <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis" value="{{ old('nis') }}" autofocus required placeholder="NIS">
            @error('nis')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        {{-- nama  siswa --}}
        <div class="mb-3">
            <label for="nama_siswa" class="form-label">Nama Siswa</label>
            <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" id="nama_siswa" name="nama_siswa" value="{{ old('nama_siswa') }}" autofocus required placeholder="Nama Siswa">
            @error('nama_siswa')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
         {{-- kelas_id --}}
         <div class="mb-3">
            <label for="kelas_id" class="form-label">Kelas</label>
            <input type="text" class="form-control @error('kelas_id') is-invalid @enderror" id="kelas_id" name="kelas_id" value="{{ old('kelas_id') }}" autofocus required placeholder="kelas">
            @error('kelas_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
         {{-- jenis_kelamin --}}
         <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <input type="text" class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" value="{{ old('jenis_kelamin') }}" autofocus required placeholder="Jenis Kelamin">
            @error('jenis_kelamin')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        {{-- agama --}}
        <div class="mb-3">
            <label for="agama" class="form-label">Agama</label>
            <input type="text" class="form-control @error('agama') is-invalid @enderror" id="agama" name="agama" value="{{ old('agam') }}" autofocus required placeholder="agama">
            @error('agama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    
        {{-- alamat --}}
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}" autofocus required placeholder="Alamat">
            @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mb-3">Simpan Perubahan</button>
        <a href="{{ route('siswa.index') }}" class="btn btn-danger mb-3">Batal</a>
    </form>
@endsection