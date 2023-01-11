<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JawatanController;
use App\Http\Controllers\JenisAduanController;
use App\Http\Controllers\JenisPengemaskinianController;
use App\Http\Controllers\KategoriMaklumatController;
use App\Http\Controllers\KategoriSaluranController;
use App\Http\Controllers\KelulusanController;
use App\Http\Controllers\LamanWebController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SokonganController;
use App\Models\LamanWeb;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('logout', [AdminController::class,'logout'])->name('logout');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard.dashboard');
    })->name('dashboard');
});

Route::prefix('pentadbiran')->group(function () {
    // jabatan route begin
    Route::get('jabatan/all', [JabatanController::class,'allJabatan'])->name('all.jabatan');
    Route::get('jabatan/add', [JabatanController::class,'addJabatan'])->name('add.jabatan');
    Route::post('jabatan/create', [JabatanController::class,'createJabatan'])->name('create.jabatan');
    Route::get('jabatan/edit/{id}', [JabatanController::class,'editJabatan'])->name('edit.jabatan');
    Route::post('jabatan/update/{id}', [JabatanController::class,'updateJabatan'])->name('update.jabatan');
    // jabatan route end

    // jawatan route begin
    Route::get('jawatan/all', [JawatanController::class,'allJawatan'])->name('all.jawatan');
    Route::get('jawatan/add', [JawatanController::class,'addJawatan'])->name('add.jawatan');
    Route::post('jawatan/create', [JawatanController::class,'createJawatan'])->name('create.jawatan');
    Route::get('jawatan/edit/{id}', [JawatanController::class,'editJawatan'])->name('edit.jawatan');
    Route::post('jawatan/update/{id}', [JawatanController::class,'updateJawatan'])->name('update.jawatan');
    // jawatan route end

    // alluser route begin
    Route::get('pengguna/all', [AdminController::class,'allPengguna'])->name('admin.all.pengguna');
    Route::get('pengguna/add', [AdminController::class,'addPengguna'])->name('admin.add.pengguna');
    Route::post('pengguna/create', [AdminController::class,'createPengguna'])->name('admin.create.pengguna');
    Route::get('pengguna/edit/{id}', [AdminController::class,'editPengguna'])->name('admin.edit.pengguna');
    Route::post('pengguna/update/{id}', [AdminController::class,'updatePengguna'])->name('admin.update.pengguna');
    // alluser route end
    
    // kategori maklumat route begin
    Route::get('kategori maklumat/all', [KategoriMaklumatController::class,'allKategoriMaklumat'])->name('admin.all.kategorimaklumat');
    Route::get('kategori maklumat/add', [KategoriMaklumatController::class,'addKategoriMaklumat'])->name('admin.add.kategorimaklumat');
    Route::post('kategori maklumat/create', [KategoriMaklumatController::class,'createKategoriMaklumat'])->name('admin.create.kategorimaklumat');
    Route::get('kategori maklumat/edit/{id}', [KategoriMaklumatController::class,'editKategoriMaklumat'])->name('admin.edit.kategorimaklumat');
    Route::post('kategori maklumat/update/{id}', [KategoriMaklumatController::class,'updateKategoriMaklumat'])->name('admin.update.kategorimaklumat');
    // kategori maklumat route end
    
    // kategori saluran route begin
    Route::get('kategori saluran/all', [KategoriSaluranController::class,'allKategoriSaluran'])->name('admin.all.kategorisaluran');
    Route::get('kategori saluran/add', [KategoriSaluranController::class,'addKategoriSaluran'])->name('admin.add.kategorisaluran');
    Route::post('kategori saluran/create', [KategoriSaluranController::class,'createKategoriSaluran'])->name('admin.create.kategorisaluran');
    Route::get('kategori saluran/edit/{id}', [KategoriSaluranController::class,'editKategoriSaluran'])->name('admin.edit.kategorisaluran');
    Route::post('kategori saluran/update/{id}', [KategoriSaluranController::class,'updateKategoriSaluran'])->name('admin.update.kategorisaluran');
    // kategori saluran route end
    
    // jenis pengemaskinian route begin
    Route::get('jenis pengemaskinian/all', [JenisPengemaskinianController::class,'allJenisPengemaskinian'])->name('admin.all.jenispengemaskinian');
    Route::get('jenis pengemaskinian/add', [JenisPengemaskinianController::class,'addJenisPengemaskinian'])->name('admin.add.jenispengemaskinian');
    Route::post('jenis pengemaskinian/create', [JenisPengemaskinianController::class,'createJenisPengemaskinian'])->name('admin.create.jenispengemaskinian');
    Route::get('jenis pengemaskinian/edit/{id}', [JenisPengemaskinianController::class,'editJenisPengemaskinian'])->name('admin.edit.jenispengemaskinian');
    Route::post('jenis pengemaskinian/update/{id}', [JenisPengemaskinianController::class,'updateJenisPengemaskinian'])->name('admin.update.jenispengemaskinian');
    // jenis pengemaskinian route end
    
    // jenis aduan route begin
    Route::get('jenis aduan/all', [JenisAduanController::class,'allJenisAduan'])->name('admin.all.jenisaduan');
    Route::get('jenis aduan/add', [JenisAduanController::class,'addJenisAduan'])->name('admin.add.jenisaduan');
    Route::post('jenis aduan/create', [JenisAduanController::class,'createJenisAduan'])->name('admin.create.jenisaduan');
    Route::get('jenis aduan/edit/{id}', [JenisAduanController::class,'editJenisAduan'])->name('admin.edit.jenisaduan');
    Route::post('jenis aduan/update/{id}', [JenisAduanController::class,'updateJenisAduan'])->name('admin.update.jenisaduan');
    // jenis aduan route end

});

Route::prefix('pengguna')->group(function () {

    // profile route begin
    Route::get('profil/current/{id}', [ProfileController::class,'profilePengguna'])->name('profile.pengguna');
    Route::get('profil/edit/{id}', [ProfileController::class,'editProfilePengguna'])->name('edit.profile.pengguna');
    Route::post('profil/update/{id}', [ProfileController::class,'updateProfilePengguna'])->name('update.profile.pengguna');
    // profile route end

    // profile change password route begin    
    Route::get('profil password/edit/{id}', [ProfileController::class,'editPasswordPengguna'])->name('edit.password.pengguna');
    Route::post('profil password/update/{id}', [ProfileController::class,'updatePasswordPengguna'])->name('update.password.pengguna');
    // profile change password route end
});

Route::prefix('permohonan')->group(function () {
    // permohonan laman web route begin
        Route::get('laman web/all', [LamanWebController::class,'allPermohonanLamanWeb'])->name('all.permohonan.lamanweb');
        Route::get('laman web/add', [LamanWebController::class,'addPermohonanLamanWeb'])->name('add.permohonan.lamanweb');
        Route::get('laman web/view/{id}', [LamanWebController::class,'PermohonanLamanWebView'])->name('permohonan.lamanweb.view');
        Route::post('laman web/create', [LamanWebController::class,'createPermohonanLamanWeb'])->name('create.permohonan.lamanweb');
        Route::get('laman web/edit/{id}', [LamanWebController::class,'editPermohonanLamanWeb'])->name('edit.permohonan.lamanweb');
        Route::post('laman web/update/{id}', [LamanWebController::class,'updatePermohonanLamanWeb'])->name('update.permohonan.lamanweb');
    // permohonan laman web route end
});

Route::prefix('sokongan')->group(function () {
    // sokongan laman web route begin
        Route::get('laman web/all', [SokonganController::class,'allSokonganLamanWeb'])->name('all.sokongan.lamanweb');
        Route::get('laman web/edit/{id}', [SokonganController::class,'editSokonganLamanWeb'])->name('edit.sokongan.lamanweb');
        Route::post('laman web/update/{id}', [SokonganController::class,'updateSokonganLamanWeb'])->name('update.sokongan.lamanweb');
    // sokongan laman web route end
});

Route::prefix('kelulusan')->group(function () {
    // kelulusan laman web route begin
        Route::get('laman web/all', [KelulusanController::class,'allKelulusanLamanWeb'])->name('all.kelulusan.lamanweb');
        Route::get('laman web/edit/{id}', [KelulusanController::class,'editKelulusanLamanWeb'])->name('edit.kelulusan.lamanweb');
        Route::post('laman web/update/{id}', [KelulusanController::class,'updateKelulusanLamanWeb'])->name('update.kelulusan.lamanweb');
    // kelulusan laman web route end
});

Route::prefix('laporan')->group(function () {
    // laporan laman web route begin
        Route::get('laman web/all', [LaporanController::class,'allLaporanLamanWeb'])->name('all.laporan.lamanweb');
        Route::get('laman web/edit/{id}', [LaporanController::class,'editLaporanLamanWeb'])->name('edit.laporan.lamanweb');
        Route::post('laman web/update/{id}', [LaporanController::class,'updateLaporanLamanWeb'])->name('update.laporan.lamanweb');
    // laporan laman web route end
});






