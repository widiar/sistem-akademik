<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SiteController;
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
            Route::resource('banner', BannerController::class);
            Route::resource('news', NewsController::class);

            //akademik

        });
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});
