<?php

use App\Http\Controllers\BotManController;
use App\Models\NgAtividades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProgressaoController;


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
Route::get('/generatePdfuser/{id}', [PdfController::class, 'generatePdfuser'])->name('pdf_generatePdfuser');
//Route::get('/generatePdfuser/pdf', [PdfController::class, 'generatePdfuser'])->name('pdf.generatePdfuser');
Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
Route::get('/chat', function () {
    return view('chat');
});


// Relatorios Progressão
Route::get('/progressao/todos-certificados', [ProgressaoController::class, 'imprimirRelatorio'])->name('progressao.todosCertificados');
Route::get('/progressao/contar-relatorios', [ProgressaoController::class, 'imprimirRelatorio'])->name('progressao.contarRelatorios');
Route::get('/progressao/relatorios-usuario', [ProgressaoController::class, 'imprimirRelatorio'])->name('progressao.relatoriosUsuario');
Route::get('/progressao/imprimir-relatorio/{tipo}/{progressaoId?}', [ProgressaoController::class, 'imprimirRelatorio'])->name('progressao.imprimirRelatorio');
Route::get('/progressao/analises/{progressaoId}', [ProgressaoController::class, 'imprimirRelatorio'])->name('progressao.analises');

Route::view('/error', 'error')->name('error');

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
