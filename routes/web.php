<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\HomeController;

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
    return view('welcome');
});

Route::group(['prefix' => 'doctors'], function () {
    Route::get('', [DoctorController::class, 'index'])->name('doctor.index');
    Route::get('create', [DoctorController::class, 'create'])->name('doctor.create');
    Route::post('store', [DoctorController::class, 'store'])->name('doctor.store');

    Route::get('edit/{doctor}', [DoctorController::class, 'edit'])->name('doctor.edit');
    Route::post('update/{doctor}', [DoctorController::class, 'update'])->name('doctor.update');
    Route::post('delete/{doctor}', [DoctorController::class, 'destroy'])->name('doctor.destroy');
    Route::get('show/{doctor}', [DoctorController::class, 'show'])->name('doctor.show');
});

Route::group(['prefix' => 'owners'], function () {
    Route::get('', [OwnerController::class, 'index'])->name('owner.index');
    Route::get('create', [OwnerController::class, 'create'])->name('owner.create');
    Route::post('store', [OwnerController::class, 'store'])->name('owner.store');

    Route::get('edit/{owner}', [OwnerController::class, 'edit'])->name('owner.edit');
    Route::post('update/{owner}', [OwnerController::class, 'update'])->name('owner.update');
    Route::post('delete/{owner}', [OwnerController::class, 'destroy'])->name('owner.destroy');
    Route::get('show/{owner}', [OwnerController::class, 'show'])->name('owner.show');
});

Route::group(['prefix' => 'pets'], function () {
    Route::get('', [PetController::class, 'index'])->name('pet.index');
    Route::get('create', [PetController::class, 'create'])->name('pet.create');
    Route::post('store', [PetController::class, 'store'])->name('pet.store');
    Route::get('edit/{pet}', [PetController::class, 'edit'])->name('pet.edit');
    Route::post('update/{pet}', [PetController::class, 'update'])->name('pet.update');
    Route::post('delete/{pet}', [PetController::class, 'destroy'])->name('pet.destroy');
    Route::get('show/{pet}', [PetController::class, 'show'])->name('pet.show');

    Route::get('pdf/{pet}', [PetController::class, 'pdf'])->name('pet.pdf');
});


//Auth::routes(['register' => false]);


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');