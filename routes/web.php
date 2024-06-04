<?php

use App\Models\NgAtividades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;


Route::get('/test-professor', function () {
    // Criar um novo professor
    $ngatividades = NgAtividades::create([
        'grupo_atividade' => 'Nome do Professor',
        'nome_atividade' => 'professor@example.com',
        'valor_unitario' => 'Nome do Professor',
        'percentual_maximo' => 'professor@example.com',
    ]);

    // Exibir os dados do professor criado
    dd($ngatividades);
});
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

// routes/web.php


Route::get('/ng-certificados/pdf', [PdfController::class, 'generatePdf'])->name('ng-certificados.pdf');
Route::get('/reports/pdf', [PdfController::class, 'generatePdf1'])->name('reports.pdf');


Route::get('/', function () {
    return view('welcome');
});
// Route::get('/login', function () {
//     return redirect(route('filament.admin.auth.login'));
// })->name('login');
Route::get('/logout', function () {
    Auth::logout();
    return redirect(route('login'));
})->name('logout');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
