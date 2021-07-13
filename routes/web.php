<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function ()
{
    Route::get('/admin/register', [App\Http\Controllers\LoginController::class, 'registerForm'])->name('registerForm');
    Route::post('/admin/register', [App\Http\Controllers\LoginController::class, 'register'])->name('register');
});

//Rotas de Autenticação

Route::get('/admin/login', [App\Http\Controllers\LoginController::class, 'loginForm'])->name('loginForm');
Route::post('/admin/login', [App\Http\Controllers\LoginController::class, 'authenticate'])->name('auth');
Route::get('/admin/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

//Reset de senha
Route::get('/admin/reset-password/{token}', [\App\Http\Controllers\LoginController::class, 'resetPasswordForm'])->name('resetPasswordForm');
Route::post('/admin/reset-password', [App\Http\Controllers\LoginController::class, 'resetPassword'])->name('resetPassword');

Route::get('/', [App\Http\Controllers\SearchController::class, 'index'])->name('guest.index');
Route::get('/consulta/{tipo}', [App\Http\Controllers\SearchController::class, 'tipoConsulta'])->name('guest.tipoConsulta');
Route::post('/consulta/resultado', [App\Http\Controllers\SearchController::class, 'search'])->name('guest.search');
Route::get('/show/{id}', [App\Http\Controllers\SearchController::class, 'show'])->name('guest.show');
 
Route::get('/admin', [App\Http\Controllers\SheetsImportController::class, 'index'])->name('admin.index');
Route::post('/admin', [App\Http\Controllers\SheetsImportController::class, 'store'])->name('admin.store');
Route::get('/admin/table/pagamentos_orcamentarios', [App\Http\Controllers\SheetsImportController::class, 'tablePagamentosOrcamentarios'])->name('admin.tablePO');

Route::get('/admin/export', [App\Http\Controllers\SheetsExportController::class, 'export'])->name('export');




