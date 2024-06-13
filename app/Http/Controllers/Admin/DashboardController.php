<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $siswas = Siswa::where('validasi', '=', '2')->orderby('nama_siswa')->get();
        return view('pages.admin.dashboard', [
            'title'     => 'Dashboard',
            'siswa'    => Siswa::where('validasi', '=', '2')->count(),
            'criterias' => Criteria::count(),
            'kelas'     => Kelas::count(),
            'users'     => User::whereNot('id', auth()->user()->id)->count(),
            'siswas'   => $siswas,
        ]);
    }
}