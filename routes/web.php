<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\InsentifController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

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

Route::get('dev', [SiteController::class, 'dev']);

Route::get('/', [SiteController::class, 'index'])->name("home");
Route::get('news/{slug}', [SiteController::class, 'news'])->name('news');
Route::get('news', [SiteController::class, 'allNews'])->name('news.all');

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'doLogin']);

Route::middleware(['auth'])->group(function () {
    Route::name('admin.')->group(function () {
        Route::prefix('/admin')->group(function () {
            Route::get('/', function () {
                return redirect()->route('admin.login');
            });
            Route::get('logout', [AdminController::class, 'logout'])->name('logout');
            Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

            //pemasaran
            Route::middleware(['marketing'])->group(function () {
                Route::resource('banner', BannerController::class);
                Route::resource('news', NewsController::class);
                Route::get('master/insentif-marketing', [InsentifController::class, 'master'])->name('insentif.master');
                Route::post('master/insentif-marketing', [InsentifController::class, 'masterPost']);
                Route::get('insentif-marketing', [InsentifController::class, 'index'])->name('insentif-marketing.index');
                Route::get('insentif-marketing/{staff}/{tanggal}', [InsentifController::class, 'edit'])->name('insentif-marketing.edit');
                Route::put('insentif-marketing/{staff}/{tanggal}', [InsentifController::class, 'update']);
                Route::get('rekap/insentif-marketing', [InsentifController::class, 'rekap'])->name('rekap.insentif');
                Route::post('rekap/insentif-marketing', [InsentifController::class, 'postRekap'])->name('rekap.insentif.post');
                Route::delete('rekap/insentif-marketing/{id}', [InsentifController::class, 'deleteRekap'])->name('rekap.insentif.delete');
            });

            //akademik
            Route::get('rekap-dosen', [RekapController::class, 'dosen'])->name('rekap.dosen'); //keuangan bisa
            Route::middleware(['akademik'])->group(function () {

                Route::get('dosen', [DosenController::class, 'index'])->name('dosen');
                // Route::get('dosen/create', [DosenController::class, 'create'])->name('dosen.create');
                // Route::post('dosen/create', [DosenController::class, 'store'])->name('dosen.store');
                Route::get('laporan-bulanan/dosen/{pegawai}/edit/{bulan}', [DosenController::class, 'edit'])->name('dosen.edit');
                Route::patch('dosen/{dosen}', [DosenController::class, 'update'])->name('dosen.update');
                Route::delete('dosen/{dosen}', [DosenController::class, 'destroy'])->name('dosen.destroy');
                Route::get('laporan-bulanan/dosen', [DosenController::class, 'laporanBulanan'])->name('dosen.laporan.bulanan');
                // Route::get('dosen/{tipe}', [DosenController::class, 'list'])->name('dosen.list');
                Route::post('dosen-rekap', [RekapController::class, 'dosenRekap'])->name('add.rekap.dosen');
                Route::delete('rekap-dosen/{id}', [RekapController::class, 'deleteRekapDosen'])->name('delete.rekap.dosen');
                Route::get('absen-dosen', [AbsenController::class, 'dosen'])->name('absen.dosen');
                Route::get('list/absen-dosen', [AbsenController::class, 'list'])->name('list.absen.dosen');
                Route::get('cek-sks/{dosen}', [AbsenController::class, 'cekSks'])->name('cek.sks');
                Route::get('ambil-absen/{dosen}/{bulan}', [AbsenController::class, 'ambilAbsenDosen'])->name('cek.absen.dosen');
                Route::post('absen-dosen', [AbsenController::class, 'postAbsenDosen'])->name('post.absen.dosen');

                Route::get('mata-kuliah', [MataKuliahController::class, 'index'])->name('matakuliah.index');
                Route::get('mata-kuliah/create', [MataKuliahController::class, 'create'])->name('matakuliah.create');
                Route::post('mata-kuliah/create', [MataKuliahController::class, 'store']);
                Route::get('mata-kuliah/{matakuliah}/edit', [MataKuliahController::class, 'edit'])->name('matakuliah.edit');
                Route::post('mata-kuliah/{matakuliah}/edit', [MataKuliahController::class, 'update']);
                Route::delete('mata-kuliah/{matakuliah}', [MataKuliahController::class, 'delete'])->name('matakuliah.delete');
                Route::get('mata-kuliah/list-dosen', [DosenController::class, 'list'])->name('dosen.list');
                Route::get('mata-kuliah/list', [MataKuliahController::class, 'list'])->name('matakuliah.list');

                Route::get('koordinator/dosen', [DosenController::class, 'koordinator'])->name('dosen.koordinator');
                Route::get('koordinator/dosen/{pegawai}/{semester}', [DosenController::class, 'editKoor'])->name('dosen.koordinator.edit');
                Route::put('koordinator/dosen/{pegawai}/{semester}', [DosenController::class, 'updateKoor']);
            });

            //keuangan
            Route::get('rekap/absen-dosen', [RekapController::class, 'absenDosen'])->name('rekap.absen.dosen');
            Route::post('rekap/absen-dosen', [RekapController::class, 'postAbsenDosen'])->name('post.rekap.absen.dosen');
            Route::delete('rekap-absen-dosen/{id}', [RekapController::class, 'deleteAbsenDosen'])->name('delete.rekap.absen.dosen');
            Route::middleware(['keuangan'])->group(function () {

                Route::prefix('/penggajian')->group(function () {
                    Route::get('staff', [GajiController::class, 'indexStaff'])->name('penggajian.staff');
                    Route::get('staff/{bulan}/{staff}', [GajiController::class, 'gajiStaff'])->name('penggajian.staff.detail');
                    Route::post('staff/{bulan}/{staff}', [GajiController::class, 'gajiStaffStore']);
                    Route::get('staff/list', [GajiController::class, 'listStaff'])->name('list.staff.gaji');
                    Route::get('staff/pdf/{bulan}/{pegawai}', [GajiController::class, 'pdfStaff'])->name('pdf.gaji.staff');

                    Route::get('dosen', [GajiController::class, 'indexDosen'])->name('penggajian.dosen');
                    Route::get('dosen/list', [GajiController::class, 'listDosen'])->name('list.dosen.gaji');
                    Route::get('dosen/{bulan}/{dosen}', [GajiController::class, 'gajiDosen'])->name('penggajian.dosen.detail');
                    Route::post('dosen/{bulan}/{dosen}', [GajiController::class, 'gajiDosenStore']);
                    Route::get('dosen/pdf/{bulan}/{pegawai}', [GajiController::class, 'pdfDosen'])->name('pdf.gaji.dosen');
                });
                Route::get('laporan/penggajian', [GajiController::class, 'laporan'])->name('laporan.gaji');
                Route::post('laporan/penggajian', [GajiController::class, 'buatLaporan'])->name('laporan.gaji.create');
                Route::delete('laporan/penggajian/{id}', [GajiController::class, 'deleteLaporan'])->name('laporan.gaji.delete');
            });

            //hrd
            Route::middleware(['hrd'])->group(function () {
                Route::resource('staff', StaffController::class);

                Route::get('absen-staff', [AbsenController::class, 'staff'])->name('absen.staff');
                // Route::get('list/absen-staff', [AbsenController::class, 'listStaff'])->name('absen.staff.list');
                // Route::post('absen-staff', [AbsenController::class, 'absenStaff'])->name('absen.staff.post');
                Route::get('absen-staff/{pegawai}/{bulan}', [AbsenController::class, 'showAbsenStaff'])->name('show.absen.staff');
                Route::put('absen-staff/{pegawai}/{bulan}', [AbsenController::class, 'postAbsenStaff'])->name('post.absen.staff');
                Route::post('rekap/absen-staff', [RekapController::class, 'postAbsenStaff'])->name('rekap.absen.staff.post');
                Route::delete('rekap/absen-staff/{id}', [RekapController::class, 'deleteAbsenStaff'])->name('delete.absen.staff');

                Route::get('hari-efektif', [StaffController::class, 'hariEfektif'])->name('hari.efektif');
                Route::post('hari-efektif', [StaffController::class, 'postHariEfektif']);
                Route::put('hari-efektif', [StaffController::class, 'putHariEfektif']);
            });

            Route::get('rekap/absen-staff', [RekapController::class, 'absenStaff'])->name('rekap.absen.staff');

            //dev
            Route::get('dev', [RekapController::class, 'dev']);
        });
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});
