<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllatController; // JAVÍTVA: Nagybetűs AllatController
use App\Http\Controllers\DiagramController;
use App\Http\Controllers\ProfileController;
use App\Models\Allat;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KapcsolatController;

Route::get('/', function () {
    return view('welcome', ["allatok" => Allat::all()]);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('allat', AllatController::class);

Route::get('/kapcsolat', [KapcsolatController::class, 'index'])->name('kapcsolat.index');
Route::post('/kapcsolat', [KapcsolatController::class, 'store'])->name('kapcsolat.store');

Route::get('/diagram', [DiagramController::class, 'index'])->name('diagram.index');

Route::get('/uzenetek', [KapcsolatController::class, 'uzenetek'])
    ->middleware('auth')
    ->name('uzenetek.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
