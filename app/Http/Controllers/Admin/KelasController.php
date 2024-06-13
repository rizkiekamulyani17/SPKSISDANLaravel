<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KelasStoreRequest;
use App\Http\Requests\Admin\KelasUpdateRequest;
use App\Models\Kelas;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // mengurutkan
        $kelas = Kelas::orderby('kelas_name')->get();
        return view('pages.admin.kelas.data', [
            'title'   => 'Data Kelas Siswa',
            'siswas' => '',
            'kelases' => $kelas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->level !== 'ADMIN') {
            return redirect()->back()->with('error', 'Anda Tidak Memiliki Ijin Untuk Melakukan Tindakan Ini.');
        }

        return view('pages.admin.kelas.create', [
            'title' => 'Tambah Kelas Siswa',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelasStoreRequest $request)
    {
        if (auth()->user()->level !== 'ADMIN') {
            return redirect()->back()->with('error', 'Anda Tidak Memiliki Ijin Untuk Melakukan Tindakan Ini.');
        }

        $validatedData = $request->validate([
            'kelas_name' => 'required|max:30|unique:kelas',
        ]);
        $request['slug'] = Str::slug($request->kelas_name, '-');
        Kelas::create($validatedData);
        return redirect('/dashboard/data/kelas')->with('success', "Tambah Kelas Baru Berhasil");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->level !== 'ADMIN') {
            return redirect()->back()->with('error', 'Anda Tidak Memiliki Ijin Untuk Melakukan Tindakan Ini.');
        }

        $kelas = Kelas::FindOrFail($id);
        return view('pages.admin.kelas.edit', [
            'title'   => "Edit Kelas $kelas->kelas_name",
            'kelases' => $kelas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(KelasUpdateRequest $request, $id)
    {
        if (auth()->user()->level !== 'ADMIN') {
            return redirect()->back()->with('error', 'Anda Tidak Memiliki Ijin Untuk Melakukan Tindakan Ini.');
        }

        $validatedData = $request->validated();
        $validatedData['slug'] = Str::slug($validatedData['kelas_name'], '-');
        $item = Kelas::findOrFail($id);
        $item->update($validatedData);
        return redirect('/dashboard/data/kelas')->with('success', 'Kelas Siswa yang Dipilih Telah Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->level !== 'ADMIN') {
            return redirect()->back()->with('error', 'Anda Tidak Memiliki Ijin Untuk Melakukan Tindakan Ini.');
        }
        
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return redirect('/dashboard/data/kelas')->with('success', 'Kelas Siswa yang Dipilih Telah Dihapus!');
    }

    public function siswas(Kelas $kelas)
    {
        return view('pages.admin.kelas.detail', [
            'title'   => $kelas->kelas_name,
            'siswas' => $kelas->siswas,
            'active'  => 'kelas',
            'kelas'   => $kelas->kelas,
        ]);
    }
}