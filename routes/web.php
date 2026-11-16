<?php

use App\Http\Controllers\CreateKcdController;
use App\Http\Controllers\CrudGuruController;
use App\Http\Controllers\CrudGuruPrestasiController;
use App\Http\Controllers\CrudKeahlianController;
use App\Http\Controllers\CrudMapelController;
use App\Http\Controllers\CrudPtkController;
use App\Http\Controllers\CrudRombelController;
use App\Http\Controllers\CrudRuanganController;
use App\Http\Controllers\CrudSaprasController;
use App\Http\Controllers\CrudSiswaPrestasiController;
use App\Http\Controllers\DeleteSekolahController;
use App\Http\Controllers\ExportSekolahController;
use App\Http\Controllers\ImportSekolahController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KcdController;
use App\Http\Controllers\KcdExportController;
use App\Http\Controllers\KcdGuruController;
use App\Http\Controllers\KcdGuruPrestasiController;
use App\Http\Controllers\KcdImportController;
use App\Http\Controllers\KcdKeahlianController;
use App\Http\Controllers\KcdMapelController;
use App\Http\Controllers\KcdProfilController;
use App\Http\Controllers\KcdPtkController;
use App\Http\Controllers\KcdRombelController;
use App\Http\Controllers\KcdRuanganController;
use App\Http\Controllers\KcdSaprasController;
use App\Http\Controllers\KcdSekolahController;
use App\Http\Controllers\KcdSiswaController;
use App\Http\Controllers\KcdSuratController;
use App\Http\Controllers\SekolahGuruController;
use App\Http\Controllers\SekolahMapelController;
use App\Http\Controllers\SekolahProfilController;
use App\Http\Controllers\SekolahPtkController;
use App\Http\Controllers\SekolahRombelController;
use App\Http\Controllers\SekolahRuanganController;
use App\Http\Controllers\SekolahSaprasController;
use App\Http\Controllers\SekolahSiswaPController;
use App\Http\Controllers\SekolahUserController;
use App\Http\Controllers\UpdateSekolahController;
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
//index
Route::get('/', [IndexController::class, 'index']);

//index->login sekolah

Route::get('/login-kcd', [IndexController::class, 'loginKcd']);
Route::get('/login-sekolah', [IndexController::class, 'loginSekolah']);
Route::post('/sekolah/sessions', [IndexController::class, 'storeSekolah']);
Route::post('/kcd/sessions', [IndexController::class, 'storeKcd']);
Route::post('/logout', [IndexController::class, 'destroy']);
Route::get('/getsekolah/{id}', [IndexController::class, 'getsekolah'])->name('getsekolah');
Route::get('/api/kecamatan/{id}/sekolah', [IndexController::class, 'getSekolahByKecamatan']);

// Forgot Password Routes
Route::get('/kcd/forgot-password', [\App\Http\Controllers\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/kcd/forgot-password', [\App\Http\Controllers\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/kcd/reset-password/{token}', [\App\Http\Controllers\ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/kcd/reset-password', [\App\Http\Controllers\ForgotPasswordController::class, 'reset'])->name('password.update');

//KCD


Route::group(['middleware' => ['kcd']], function () {

    Route::get('/kcd/kecamatan', [KcdController::class, 'kecamatan']);
    Route::post('/kcd/kecamatan/import', [KcdImportController::class, 'kecamatan']);
    Route::get('/kcd/kecamatan/user-export', [KcdExportController::class, 'exportUser']);
    Route::get('/kcd/kecamatan/{kecamatan}/sekolah', [KcdController::class, 'sekolah']);
    Route::get('/kcd/kecamatan/sekolah/format', [KcdImportController::class, 'formatSekolah']);
    Route::post('/kcd/kecamatan/{kecamatan}/sekolah/import', [KcdImportController::class, 'sekolah']);
    Route::patch('/kcd/sekolah/{sekolah}', [KcdController::class, 'updateSekolah'])->name('kcd.sekolah.update');
    Route::post('/kcd/sekolah/{sekolah}/reset-password', [KcdController::class, 'resetPassword'])->name('kcd.sekolah.reset-password');
    Route::get('/kcd/sekolah/{sekolah}/hapus', [KcdController::class, 'deleteSekolah']);
    Route::get('/kcd/sekolah/{sekolah}/surat-rekomendasi', [KcdSuratController::class, 'suratPDF']);
    Route::get('/kcd/sekolah/{sekolah}/profil', [KcdProfilController::class, 'profil']);
    Route::get('/kcd/sekolah/{sekolah}/ruangan', [KcdRuanganController::class, 'ruangan']);
    Route::get('/kcd/sekolah/{sekolah}/rombel', [KcdRombelController::class, 'rombel']);
    Route::get('/kcd/sekolah/{sekolah}/siswa', [KcdSiswaController::class, 'siswa']);
    Route::get('/kcd/sekolah/{sekolah}/siswa-prestasi', [KcdSiswaController::class, 'siswaPrestasi']);
    Route::get('/kcd/sekolah/{sekolah}/keahlian', [KcdKeahlianController::class, 'keahlian']);
    Route::get('/kcd/sekolah/{sekolah}/mapel', [KcdMapelController::class, 'mapel']);
    Route::get('/kcd/sekolah/{sekolah}/guru', [KcdGuruController::class, 'guru']);
    Route::get('/kcd/sekolah/{sekolah}/guru-prestasi', [KcdGuruPrestasiController::class, 'guruPrestasi']);
    Route::get('/kcd/sekolah/{sekolah}/ptk', [KcdPtkController::class, 'ptk']);
    Route::get('/kcd/sekolah/{sekolah}/{ruangan}/sapras', [KcdSaprasController::class, 'sapras']);
    Route::get('/kcd/sekolah/{sekolah}/profil', [KcdSekolahController::class, 'profil']);
    // Route::get('/kcd/kecamatan/{kecamatan}/sekolah/input', [KcdController::class, 'inputSekolah']);
    Route::post('/kcd/kecamatan/sekolah/import', [KcdImportController::class, 'sekolah']);
    Route::post('/kcd/kecamatan/sekolah/create', [CreateKcdController::class, 'createSekolah']);
    Route::post('/kcd/sekolah/create-kosong', [CreateKcdController::class, 'createSekolahKosong']);
    Route::get('/kcd/sekolah/pdf/{id}/detail', [CrudRuanganController::class, 'pdfdetailsarpras'])->name('pdfdetailsarpras');
    Route::get('/sekolah/pdf/{id}/profile', [CrudRuanganController::class, 'pdfprofilesarpras'])->name('pdfprofilesarpras');



//    export
    Route::get('/kcd/ptk/ekspor/', [\App\Http\Controllers\ExportkcdController::class, 'Exportptksekolah'])->name('eksportptk');
    Route::get('/kcd/ruangan/ekspor/{id}', [\App\Http\Controllers\ExportkcdController::class, 'exportRuangan'])->name('eksportruangan');
    Route::get('/kcd/rombel/ekspor/{id}', [\App\Http\Controllers\ExportkcdController::class, 'exportRombel'])->name('eksportrombel');
    Route::get('/kcd/guru/ekspor/', [\App\Http\Controllers\ExportkcdController::class, 'eksportguru'])->name('eksportguru');
    Route::get('/kcd/sarpras/ekspor/', [\App\Http\Controllers\ExportkcdController::class, 'Exportsarprassekolah'])->name('Exportsarprassekolah');
    Route::get('/kcd/prestasi/ekspor/', [\App\Http\Controllers\ExportkcdController::class, 'Exportprestasisekolah'])->name('Exportprestasisekolah');

//    statistika
    Route::get('/kcd/statistik', [CrudRuanganController::class, 'statistik'])->name('sekolah/statistik');


    // Profil Lembaga (Settings)
    Route::get('/profil-lembaga', [\App\Http\Controllers\KcdProfilLembagaController::class, 'edit'])->name('profil-lembaga.edit');
    Route::patch('/profil-lembaga', [\App\Http\Controllers\KcdProfilLembagaController::class, 'update'])->name('profil-lembaga.update');
    Route::patch('/profil-lembaga/account', [\App\Http\Controllers\KcdProfilLembagaController::class, 'updateAccount'])->name('profil-lembaga.update-account');

    // Master Data Management
    Route::get('/kcd/wilayah', [\App\Http\Controllers\KcdMasterController::class, 'indexKecamatan'])->name('kcd.master.kecamatan');
    Route::post('/kcd/wilayah/sync', [\App\Http\Controllers\KcdMasterController::class, 'syncKecamatan'])->name('kcd.master.kecamatan.sync');
    Route::get('/kcd/wilayah/{id}/toggle', [\App\Http\Controllers\KcdMasterController::class, 'toggleKecamatan'])->name('kcd.master.kecamatan.toggle');
    
    Route::get('/kcd/jenjang', [\App\Http\Controllers\KcdMasterController::class, 'indexJenjang'])->name('kcd.master.jenjang');
    Route::post('/kcd/jenjang', [\App\Http\Controllers\KcdMasterController::class, 'storeJenjang'])->name('kcd.master.jenjang.store');
    Route::patch('/kcd/jenjang/{id}', [\App\Http\Controllers\KcdMasterController::class, 'updateJenjang'])->name('kcd.master.jenjang.update');
    Route::delete('/kcd/jenjang/{id}', [\App\Http\Controllers\KcdMasterController::class, 'destroyJenjang'])->name('kcd.master.jenjang.destroy');
    // Route::get('/kcd/jenjang/{id}/toggle', [\App\Http\Controllers\KcdMasterController::class, 'toggleJenjang'])->name('kcd.master.jenjang.toggle');

    Route::get('/kcd/kategori', [\App\Http\Controllers\KcdMasterController::class, 'indexKategori'])->name('kcd.master.kategori');
    Route::post('/kcd/kategori', [\App\Http\Controllers\KcdMasterController::class, 'storeKategori'])->name('kcd.master.kategori.store');
    Route::patch('/kcd/kategori/{id}', [\App\Http\Controllers\KcdMasterController::class, 'updateKategori'])->name('kcd.master.kategori.update');
    Route::delete('/kcd/kategori/{id}', [\App\Http\Controllers\KcdMasterController::class, 'destroyKategori'])->name('kcd.master.kategori.destroy');
    // Route::get('/kcd/kategori/{id}/toggle', [\App\Http\Controllers\KcdMasterController::class, 'toggleKategori'])->name('kcd.master.kategori.toggle');


});
//sekolah
// profil sekolah

Route::group(['middleware' => ['sekolah']], function () {

    Route::get('/sekolah', [SekolahProfilController::class, 'profil']);
    Route::get('/sekolah/profil', [SekolahProfilController::class, 'profil']);
    Route::get('/sekolah/ptk/', [SekolahPtkController::class, 'ptk']);
    Route::get('/sekolah/guru', [SekolahGuruController::class, 'guru']);
    Route::get('/sekolah/guru-prestasi', [SekolahGuruController::class, 'guruPrestasi']);
    Route::get('/sekolah/ruangan', [SekolahRuanganController::class, 'ruangan']);
    Route::get('/sekolah/{ruangan}/sapras', [SekolahSaprasController::class, 'sapras']);
    Route::get('/sekolah/rombel', [SekolahRombelController::class, 'rombel']);
    Route::get('/sekolah/rombel/export', [SekolahRombelController::class, 'exportRombel']);
    Route::get('/sekolah/siswa', [SekolahRombelController::class, 'siswa']);
    Route::get('/sekolah/siswa-prestasi', [SekolahSiswaPController::class, 'siswaPrestasi']);
    Route::get('/sekolah/mapel', [SekolahMapelController::class, 'mapel']);
    Route::get('/sekolah/keahlian', [SekolahMapelController::class, 'keahlian']);
    Route::get('/sekolah/user', [SekolahUserController::class, 'user']);
    Route::patch('/user/update', [SekolahUserController::class, 'updateUser']);

    Route::get('/sekolah/ptk/ekspor', [ExportSekolahController::class, 'exportPtk']);
    Route::get('/sekolah/sarpras/ekspor', [ExportSekolahController::class, 'exportSapras']);
    Route::get('/sekolah/ruangan/ekspor', [ExportSekolahController::class, 'exportRuangan']);
    Route::get('/sekolah/rombel/ekspor', [ExportSekolahController::class, 'exportRombel']);
    Route::get('/sekolah/guru/ekspor', [ExportSekolahController::class, 'exportGuru']);
});

Route::group(['middleware' => ['operator_sekolah']], function () {

    Route::get('/sekolah/profil/edit', [SekolahProfilController::class, 'editProfil']);
    Route::patch('/sekolah/profil/update', [UpdateSekolahController::class, 'updateProfil']);

    // Route::get('/sekolah/ptk/input', [SekolahPtkController::class, 'inputPtk']);
    Route::get('/sekolah/ptk/format', [CrudPtkController::class, 'formatPtk']);
    Route::get('/sekolah/ptk/{ptk}/hapus', [CrudPtkController::class, 'deletePtk']);
    Route::post('/sekolah/ptk/create', [CrudPtkController::class, 'createPtk']);
    Route::post('/sekolah/ptk/import', [ImportSekolahController::class, 'importPtk']);
    Route::patch('/sekolah/ptk/update', [CrudPtkController::class, 'updatePtk']);


    Route::get('/sekolah/guru/{guru}/hapus', [CrudGuruController::class, 'deleteGuru']);
    Route::post('/sekolah/guru/import', [ImportSekolahController::class, 'importGuru']);
    Route::post('/sekolah/guru/create', [CrudGuruController::class, 'createGuru']);
    Route::patch('/sekolah/guru/update', [CrudGuruController::class, 'updateGuru']);


    Route::get('/sekolah/guru-prestasi', [\App\Http\Controllers\PrestasiController::class, 'index']);

    Route::get('/sekolah/sapras/{sapras}/hapus', [CrudSaprasController::class, 'deleteSapras'])->name('hapussapras');
    Route::get('/sekolah/ruangan/{ruangan}/hapus', [CrudRuanganController::class, 'deleteRuang']);
    Route::post('/sekolah/sapras/create', [CrudSaprasController::class, 'createSapras']);
    Route::post('/sekolah/ruangan/create', [CrudRuanganController::class, 'createRuang']);
    Route::post('/sekolah/ruangan/import', [ImportSekolahController::class, 'importRuang']);
    Route::post('/sekolah/{ruang}/sapras/import', [ImportSekolahController::class, 'importSapras']);
    Route::patch('/sekolah/sapras/update', [CrudSaprasController::class, 'updateSapras']);
    Route::patch('/sekolah/ruangan/update', [CrudRuanganController::class, 'updateRuang']);

    Route::get('/sekolah/rombel/{rombel}/hapus', [CrudRombelController::class, 'deleteRombel']);
    Route::post('/sekolah/rombel/create', [CrudRombelController::class, 'createRombel']);
    Route::post('/sekolah/rombel/import', [ImportSekolahController::class, 'importRombel']);
    Route::patch('/sekolah/rombel/update', [CrudRombelController::class, 'updateRombel']);

    Route::get('/sekolah/guru-prestasi/{guru_prestasi}/hapus', [CrudGuruPrestasiController::class, 'deleteGuruPrestasi']);
    Route::post('/sekolah/guru-prestasi/create', [CrudGuruPrestasiController::class, 'createGuruPrestasi']);
    Route::patch('/sekolah/guru-prestasi/update', [CrudGuruPrestasiController::class, 'updateGuruPrestasi']);

    Route::get('/sekolah/siswa/edit', [SekolahRombelController::class, 'editSiswa']);
    Route::patch('/sekolah/siswa/update', [CrudRombelController::class, 'updateSiswa']);

    Route::get('/sekolah/siswa-prestasi/{siswa}/hapus', [CrudSiswaPrestasiController::class, 'deleteSiswaPrestasi']);
    Route::post('/sekolah/siswa-prestasi/create', [CrudSiswaPrestasiController::class, 'createSiswaPrestasi']);
    Route::patch('/sekolah/siswa-prestasi/update', [CrudSiswaPrestasiController::class, 'updateSiswaPrestasi']);

    Route::get('/sekolah/mapel/{jam}/hapus', [CrudMapelController::class, 'deleteMapel']);
    Route::post('/sekolah/mapel/create', [CrudMapelController::class, 'createMapel']);
    Route::post('/sekolah/mapel/import', [ImportSekolahController::class, 'importMapel']);
    Route::patch('/sekolah/mapel/update', [CrudMapelController::class, 'updateMapel']);

    Route::get('/sekolah/keahlian/{jam}/hapus', [CrudKeahlianController::class, 'deleteKeahlian']);
    Route::post('/sekolah/keahlian/create', [CrudKeahlianController::class, 'createKeahlian']);
    Route::post('/sekolah/keahlian/import', [ImportSekolahController::class, 'importKeahlian']);
    Route::patch('/sekolah/keahlian/update', [CrudKeahlianController::class, 'updateKeahlian']);



//    add unit
    Route::get('/sekolah/unit', [CrudRuanganController::class, 'addunit'])->name('addunit');
    Route::post('/sekolah/simpanunit', [CrudRuanganController::class, 'simpanunit'])->name('simpanunit');
    Route::put('/sekolah/updateunit/{id}', [CrudRuanganController::class, 'updateunit'])->name('updateunit');
//    hapus
    Route::get('/sekolah/hapusunit/{id}', [CrudRuanganController::class, 'hapusunit'])->name('hapusunit');


    Route::get('/sekolah/{sekolah}/sapras/{detail}/detail', [CrudRuanganController::class, 'show']);
    Route::post('/sekolah/simpansarpras', [CrudRuanganController::class, 'storedetail'])->name('savedetailsapras');
    Route::get('/sekolah/detailsapras/{id}/hapus', [CrudRuanganController::class, 'destroydetail'])->name('destroydetail');


//    subkateogir

    Route::post('/sekolah/subkategori', [CrudRuanganController::class, 'subkategori'])->name('subkategori');
    Route::get('/sekolah/deletesubkategori/{id}', [CrudRuanganController::class, 'deletesubkategori'])->name('deletesubkategori');


//    parameter
    Route::post('/sekolah/parameters', [CrudRuanganController::class, 'parameters'])->name('parameters');
    Route::get('/sekolah/deleteparameters/{id}', [CrudRuanganController::class, 'deleteparameter'])->name('deleteparameters');
    Route::post('/sekolah/parameter/{id}/edit', [CrudRuanganController::class, 'editparametersekolah'])->name('editparametersekolah');
    Route::get('/sekolah/parameter/{id}/hapus', [CrudRuanganController::class, 'deleteparametersekolah'])->name('deleteparametersekolah');

    Route::get('/sekolah/{sekolah}/sarpras/{id}/add', [CrudRuanganController::class, 'createdetail'])->name('detailsarprasadd');
    Route::post('/sekolah/parametersekolah', [CrudRuanganController::class, 'parametersekolah'])->name('parametersekolah');

//    pdf
    Route::get('/sekolah/pdf/{id}', [CrudRuanganController::class, 'pdfsarpras'])->name('pdfsarpras');
});

Route::get('/debug-profil', function() {
    return \App\Models\ProfilLembaga::first();
});
