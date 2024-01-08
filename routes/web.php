<?php

use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\Letters;
use App\Models\LetterTypes;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\SuratGuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KlasifikasiSuratController;
use Illuminate\Support\Facades\Auth;


/*
|------------------------- -------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/v2', function () {
   return view('layouts.appv2');
});
Route::middleware('auth')->get('/', [HomeController::class, 'index'])->name('index');

// STAFF
Route::middleware(['auth', 'userRole:staff'])->prefix('/staff-tata-usaha')->name('staff-tata-usaha.')->group(function(){
    Route::get('/', [StaffController::class, 'index'])->name('index');
    Route::get('/create', [StaffController::class, 'create'])->name('create');
    Route::post('/store', [StaffController::class, 'store'])->name('store');
    Route::get('/id/{id}', [StaffController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [StaffController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [StaffController::class, 'destroy'])->name('delete');
});
// GURU
Route::middleware(['auth', 'userRole:staff'])->prefix('/data-guru')->name('data-guru.')->group(function(){
    Route::get('/', [GuruController::class, 'index'])->name('index');
    Route::get('/create', [GuruController::class, 'create'])->name('create');
    Route::post('/store', [GuruController::class, 'store'])->name('store');
    Route::get('/id/{id}', [GuruController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [GuruController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [GuruController::class, 'destroy'])->name('delete');
});
// SURAT
Route::middleware(['auth', 'userRole:staff'])->prefix('/data-surat')->name('data-surat.')->group(function(){
    Route::get('/', [SuratController::class, 'index'])->name('index');
    Route::get('/create', [SuratController::class, 'create'])->name('create');
    Route::get('/preview/{id}', [SuratController::class, 'preview'])->name('preview');
    Route::get('/print_preview/{id}', [SuratController::class, 'print'])->name('print');
    Route::post('/store', [SuratController::class, 'store'])->name('store');
    Route::get('/id/{id}', [SuratController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [SuratController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [SuratController::class, 'destroy'])->name('delete');
    Route::get('/detail/{id}', [SuratController::class, 'detail'])->name('detail');
    Route::get('/download-excel', [SuratController::class, 'downloadExcel'])->name('download-excel');

});

// SURAT-GURU
Route::middleware(['auth', 'userRole:guru'])->prefix('/data-surat-guru')->name('data-surat-guru.')->group(function(){
    Route::get('/', [SuratGuruController::class, 'index'])->name('index');
    Route::get('/create/{id}', [SuratGuruController::class, 'create'])->name('create');
    Route::post('/store', [SuratGuruController::class, 'store'])->name('store');
    Route::get('/detail/{id}', [SuratGuruController::class, 'detail'])->name('detail');
    Route::get('/download-excel', [SuratGuruController::class, 'downloadExcel'])->name('download-excel');
});

// KLASIFIKASI SURAT
Route::middleware(['auth', 'userRole:staff'])->prefix('/klasifikasi-surat')->name('klasifikasi-surat.')->group(function(){
    Route::get('/', [KlasifikasiSuratController::class, 'index'])->name('index');
    Route::get('/create', [KlasifikasiSuratController::class, 'create'])->name('create');
    Route::get('/detail/{id}', [KlasifikasiSuratController::class, 'detail'])->name('detail');
    Route::get('/download-pdf/{id}', [KlasifikasiSuratController::class, 'download'])->name('download');
    Route::post('/store', [KlasifikasiSuratController::class, 'store'])->name('store');
    Route::get('/id/{id}', [KlasifikasiSuratController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [KlasifikasiSuratController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [KlasifikasiSuratController::class, 'destroy'])->name('delete');
    Route::get('/download-excel', [KlasifikasiSuratController::class, 'downloadExcel'])->name('download-excel');

});

Auth::routes();

Route::middleware(['auth', 'userRole:staff'])->group(function () {
    Route::get("/staff-only", function () {
        return "staff only";
    });
});

Route::middleware(['auth', 'userRole:guru'])->group(function () {
    Route::get("/guru-only", function () {
        return "guru only";
    });
});

Route::get('klasifikasi-surat-pdf', function () {
    return view('data-klasifikasi-surat.pdf-klasifikasi-surat');
});

Route::get('download-pdf-klasifikasi-surat', function () {
    $pdf = Pdf::loadView('data-klasifikasi-surat.pdf-klasifikasi-surat');

    return $pdf->download('002 Rapat rutin.pdf');
});

Route::get('generate-password', function() {
    return Hash::make("admin123");
});