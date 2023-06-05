<?php

use App\Http\Controllers\FotoController;
use App\Http\Livewire\VerUserFotos;
use App\Models\Foto;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $fotos=Foto::with('user', 'category')
    ->where('publicada', 'SI')
    ->orderBy('id', 'desc')
    ->paginate(5);

    return view('welcome', compact('fotos'));
})->name('inicio');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('dashboard', VerUserFotos::class)->name('dashboard');
    Route::get('dashboard/{foto}/edit', [FotoController::class, 'detalle'])->name('foto.detalle');
});
