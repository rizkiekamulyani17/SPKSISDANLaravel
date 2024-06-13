<?php

namespace App\Http\Controllers;

// use App\Models\Comment;
use App\Models\Criteria;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.portal', [
            'siswa'    => Siswa::where('validasi', '=', '2')->count(),
            'criterias' => Criteria::count(),
            'kelas'     => Kelas::count(),
            'users'     => User::count(),
        ]);
    }
}