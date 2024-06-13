<?php

use App\Http\Controllers\Admin\AhpController;
use App\Http\Controllers\Admin\AlternativeController;
use App\Http\Controllers\Admin\CriteriaController;
use App\Http\Controllers\Admin\SaranController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\KombinasiController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RankingController;
use App\Http\Controllers\Admin\SawController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\FreeController;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',  [PortalController::class, 'index'])->name('portal.index');

Route::get('/spk', [FreeController::class, 'index'])->name('free.index');
Route::get('/spk/data/kriteria', [FreeController::class, 'kriteria'])->name('free.kriteria');
Route::get('/spk/data/siswa', [FreeController::class, 'siswa'])->name('free.siswa');
Route::get('/spk/data/kelas', [FreeController::class, 'kelas'])->name('free.kelas');
Route::get('/spk/data/kelas/{kelas:slug}', [FreeController::class, 'kelasSlug'])->name('free.kelasSlug');
Route::get('/spk/data/alternatif', [FreeController::class, 'alternatif'])->name('free.alternatif');

Route::get('/spk/perhitungan', [FreeController::class, 'awal'])->name('free.perhitungan');

Route::get('/spk/perhitungan/kombinasi/{criteria_analysis}', [FreeController::class, 'resultKombinasi'])->name('perhitungan.kombinasi');
Route::get('/spk/perhitungan/kombinasi/detail/{criteria_analysis}', [FreeController::class, 'detailKombinasi'])->name('perhitungan.kombinasiDetail');

Route::get('/spk/perhitungan/ahp/{criteria_analysis}', [FreeController::class, 'resultAHP'])->name('perhitungan.ahp');
Route::get('/spk/perhitungan/ahp/detail/{criteria_analysis}', [FreeController::class, 'detailAHP'])->name('perhitungan.ahpDetail');
Route::get('/spk/perhitungan/ahp/detailr/{criteria_analysis}', [FreeController::class, 'detailrAHP'])->name('perhitungan.ahpDetailr');

Route::get('/spk/perhitungan/saw/{criteria_analysis}', [FreeController::class, 'resultSAW'])->name('perhitungan.saw');
Route::get('/spk/perhitungan/saw/detail/{criteria_analysis}', [FreeController::class, 'detailSAW'])->name('perhitungan.sawDetail');

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'register'])->name('register.register');
Route::get('/login',  [LoginController::class, 'index'])->middleware('guest')->name('login.index');
Route::post('/login',  [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('dashboard')
    // ->namespace('Admin')
   // ->middleware('auth')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard.index');
        Route::resources([
            'data/kriteria'  => CriteriaController::class,
            'data/siswa'    => SiswaController::class,
            'data/kelas'     => KelasController::class,
            'pengguna/users' => UserController::class,
            //'sarans'         => SaranController::class,
        ], ['except' => 'show', 'middleware' => 'admin']);
        // Route::put('/dashboard/sarans/{id}/approve')
        //   ->name('sarans.approve');
        // alternatif
        Route::resource('data/alternatif', AlternativeController::class)
            ->except('show');
        // profile
        Route::get('pengguna/profile', [ProfileController::class, 'index'])
            ->name('profile.index');
        Route::put('pengguna/profile/{users}', [ProfileController::class, 'update'])
            ->name('profile.update');
        // link slug
        Route::get('data/kelas/{kelas:slug}', [KelasController::class, 'siswas'])
            ->name('kelas.siswas');
        // perhitungan
        Route::get('perhitungan/setting', [KombinasiController::class, 'index'])
            ->name('kombinasi.index');
        Route::get('perhitungan/metode', [KombinasiController::class, 'awal'])
            ->name('kombinasi.awal');
        Route::post('perhitungan/setting', [KombinasiController::class, 'store'])
            ->name('kombinasi.store');
        Route::get('perhitungan/setting/{criteria_analysis}', [KombinasiController::class, 'show'])
            ->name('kombinasi.show');
        Route::get('perhitungan/setting/perbandingan/{criteria_analysis}', [KombinasiController::class, 'show'])
            ->name('kombinasi.show');
        Route::put('perhitungan/setting/perbandingan/{criteria_analysis}', [KombinasiController::class, 'update'])
            ->name('kombinasi.update');
        Route::get('perhitungan/setting/bobot/{criteria_analysis}', [KombinasiController::class, 'showBobot'])
            ->name('kombinasi.showBobot');
        Route::put('perhitungan/setting/bobot/{criteria_analysis}', [KombinasiController::class, 'updateBobot'])
            ->name('kombinasi.updateBobot');
        Route::delete('perhitungan/setting/{criteria_analysis}', [KombinasiController::class, 'destroy'])
            ->name('kombinasi.destroy');
        Route::delete('perhitungan/rank{criteria_analysis}', [RankingController::class, 'destroy'])
            ->name('rank.detailr');
        // kombinasi
        Route::get('perhitungan/metode/kombinasi/{criteria_analysis}', [KombinasiController::class, 'result'])
            ->name('kombinasi.result');
        Route::get('perhitungan/metode/kombinasi/detail/{criteria_analysis}', [KombinasiController::class, 'detail'])
            ->name('kombinasi.detail');
            Route::get('perhitungan/metode/kombinasi/detail/{criteria_analysis}', [KombinasiController::class, 'detail'])
            ->name('kombinasi.detail');
        // ahp
        Route::get('perhitungan/metode/ahp/{criteria_analysis}', [AhpController::class, 'result'])
            ->name('ahp.result');
        Route::get('perhitungan/metode/ahp/detail/{criteria_analysis}', [AhpController::class, 'detail'])
            ->name('ahp.detail');
        Route::get('perhitungan/metode/hasil/{criteria_analysis}', [AhpController::class, 'detailr'])
            ->name('ahp.detailr');
            
        // saw
        Route::get('perhitungan/metode/saw/{criteria_analysis}', [SawController::class, 'result'])
            ->name('saw.result');
        Route::get('perhitungan/metode/saw/detail/{criteria_analysis}', [SawController::class, 'detail'])
            ->name('saw.detail');

            Route::get('perhitungan/metode/detailr/{criteria_analysis}', [RankingController::class, 'detailr'])
            ->name('rank.detailr');

            Route::get('ranking', [RankingController::class, 'index'])
            ->name('rank.index');
            Route::get('ranking/{criteria_analysis}', [RankingController::class, 'show'])
            ->name('rank.show');
        Route::get('ranking/student/{criteria_analysis}', [RankingController::class, 'final'])
            ->name('rank.final');
        Route::get('ranking/student/detailr/{criteria_analysis}', [RankingController::class, 'detailr'])
            ->name('rank.detailr');
    });
    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);
     
        $status = Password::sendResetLink(
            $request->only('email')
        );
     
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    })->middleware('guest')->name('password.email');
    
    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset-password', ['token' => $token]);
        // return 'berhasil kirim email';
    })->middleware('guest')->name('password.reset');