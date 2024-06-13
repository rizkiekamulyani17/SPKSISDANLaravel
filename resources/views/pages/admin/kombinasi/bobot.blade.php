@extends('layouts.admin')
@section('content')
<div class="container-fluid px-4">
    <div class="row align-items-center">
        <div class="col-sm-6 col-md-8">
            <h1 class="mt-4">{{ $title }}</h1>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive col-lg-12">
                <table class="table table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col" class="text-center">Kriteria</th>
                            <th scope="col" class="text-center">Bobot Kriteria</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($criteriaBobots))
                        <form action="{{ route('kombinasi.updateBobot', $criteriaBobots[0]->criteria_analysis_id) }}"
                            method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{ $criteriaBobots[0]->criteria_analysis_id }}">
                            @foreach ($criteriaBobots as $criteriaBobot)
                            <tr>
                                <input type="hidden" name="bobot_id[]" value="{{ $criteriaBobot->id }}">
                                <td class="text-center">
                                    {{ $criteriaBobot->nama_kriteria }}
                                </td>
                                <td class="text-center">
                                    <input type="text" name="value[]" value="{{ $criteriaBobot->value }}">
                                </td>
                            </tr>
                            @endforeach
                            <div class="col-lg-12">
                                @can('admin')
                                <button type="submit" class="btn mb-3 ml-4 btn-primary">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                    Simpan
                                </button>
                                @endcan
                                @if ($isDoneCounting)
                                <a href="{{ route('kombinasi.index', $criteria_analysis->id) }}"
                                    class="btn btn-success mb-3">
                                    <i class="fa-solid fa-eye"></i>
                                    Hasil
                                </a>
                                @else
                                <a class="btn btn-success disabled mb-3">
                                    <i class="fa-solid fa-eye"></i>
                                    Admin Belum Menyimpan Kriteria
                                </a>
                                @endif
                            </div>
                        </form>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection