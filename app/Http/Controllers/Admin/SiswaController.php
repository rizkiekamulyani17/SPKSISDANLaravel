<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiswaRequest;
use App\Http\Requests\Admin\SiswaUpdateRequest;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // pagination
    //protected $limit = 10;
    protected $fields = array('siswas.*');

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // mengurutkan
        $siswas = Siswa::where('validasi', '=', '2')
            ->orderby('nama_siswa');
        if (request('search')) {
            $siswas->join('kelas', 'kelas.id', '=', 'siswas.kelas_id')
                ->where('siswas.nama_siswa', 'LIKE', '%' . request('search') . '%')
                ->orWhere('siswas.nis', 'LIKE', '%' . request('search') . '%')
                ->orWhere('kelas.kelas_name', 'LIKE', '%' . request('search') . '%')
                ->get();
        }
        // Get value halaman yang dipilih dari dropdown
        $page = $request->query('page', 1);
        // Tetapkan opsi dropdown halaman yang diinginkan
        $perPageOptions = [5, 10, 15, 20, 25];
        // Get value halaman yang dipilih menggunaakan the query parameters
        $perPage = $request->query('perPage', $perPageOptions[1]);
        // Paginasi hasil dengan halaman dan dropdown yang dipilih
        $siswas = $siswas->paginate($perPage, $this->fields, 'page', $page);
        return view('pages.admin.siswa.data', [
            'title'          => 'Data siswa',
            'siswas'        => $siswas,
            'perPageOptions' => $perPageOptions,
            'perPage'        => $perPage
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

        $kelases = Kelas::orderBy('kelas_name')->get();
        return view('pages.admin.siswa.create', [
            'title'   => 'Tambah Data Siswa',
            'kelases' => $kelases,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SiswaRequest $request)
    {
        if (auth()->user()->level !== 'ADMIN') {
            return redirect()->back()->with('error', 'Anda Tidak Memiliki Ijin Untuk Melakukan Tindakan Ini.');
        }

        $validatedData = $request->validated();
        Siswa::create($validatedData);
        return redirect('/dashboard/data/siswa')->with('success', 'Destinasi Siswa Baru Telah Ditambahkan!');
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

        $siswa = Siswa::FindOrFail($id);
        $kelases = Kelas::orderBy('kelas_name')->get();
        return view('pages.admin.siswa.edit', [
            'title'   => "Edit Data $siswa->nama_siswa",
            'siswa'  => $siswa,
            'kelases' => $kelases
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SiswaUpdateRequest $request, $id)
    {
        if (auth()->user()->level !== 'ADMIN') {
            return redirect()->back()->with('error', 'Anda Tidak Memiliki Ijin Untuk Melakukan Tindakan Ini.');
        }

        $validatedData = $request->validated();
        $item = Siswa::findOrFail($id);
        $item->update($validatedData);
        return redirect('/dashboard/data/siswa')->with('success', 'Destinasi Siswa yang Dipilih Telah Diperbarui!');
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

        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return redirect('/dashboard/data/siswa')->with('success', ' Siswa yang Dipilih Telah Dihapus!');
    }
}