<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('guest.index');

Route::middleware(['auth'])->group(function ()
{
    Route::get('/admin/register', [App\Http\Controllers\LoginController::class, 'registerForm'])->name('registerForm');
    Route::post('/admin/register', [App\Http\Controllers\LoginController::class, 'register'])->name('register');
    Route::get('/admin/usuario', [App\Http\Controllers\UsersController::class, 'index'])->name('user');
    Route::delete('/admin/usuario/{id}', [App\Http\Controllers\UsersController::class, 'delete'])->name('user.delete');
});

//Rotas de Autenticação
Route::get('/admin/login', [App\Http\Controllers\LoginController::class, 'loginForm'])->name('loginForm');
Route::post('/admin/login', [App\Http\Controllers\LoginController::class, 'authenticate'])->name('auth');
Route::get('/admin/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

//Reset de senha
Route::get('/admin/reset-password/email', [App\Http\Controllers\ForgotPasswordController::class, 'index'])->name('resetPasswordEmail');
Route::post('/admin/reset-password/email', [\App\Http\Controllers\ForgotPasswordController::class, 'sendEmail'])->name('sendEmail');
Route::get('/admin/reset-password/{token}', [App\Http\Controllers\ForgotPasswordController::class, 'resetPasswordForm'])->name('resetPasswordForm');
Route::post('/admin/reset-password', [App\Http\Controllers\ForgotPasswordController::class, 'resetPassword'])->name('resetPassword');

//Rotas de importação e exportação de Excel 
Route::get('/admin', [App\Http\Controllers\SheetsImportController::class, 'index'])->name('admin.index');
Route::post('/admin', [App\Http\Controllers\SheetsImportController::class, 'store'])->name('admin.store');
Route::get('/admin/table/pagamentos_orcamentarios', [App\Http\Controllers\SheetsImportController::class, 'tablePagamentosOrcamentarios'])->name('admin.tablePO');

Route::get('/admin/export', [App\Http\Controllers\SheetsExportController::class, 'export'])->name('export');

//Rotas de Pagamentos Orcamentarios
Route::get('pagamentos-orcamentarios', [App\Http\Controllers\PagamentosOrcamentarioController::class, 'index'])->name('pagamentos-orcamentarios.index');
Route::post('pagamentos-orcamentarios', [App\Http\Controllers\PagamentosOrcamentarioController::class, 'search'])->name('pagamentos-orcamentarios.search'); //consulta
Route::get('pagamentos-orcamentarios/visualizar/{id}', [App\Http\Controllers\PagamentosOrcamentarioController::class, 'visualizar'])->name('pagamentos-orcamentarios.visualizar');

//Rotas de Restos a Pagar
Route::get('restos-a-pagar', [App\Http\Controllers\RestosAPagarController::class, 'index'])->name('restos-a-pagar.index');
Route::post('restos-a-pagar', [App\Http\Controllers\RestosAPagarController::class, 'search'])->name('restos-a-pagar.search'); //consulta
Route::get('restos-a-pagar/visualizar/{id}', [App\Http\Controllers\RestosAPagarController::class, 'visualizar'])->name('restos-a-pagar.visualizar');

//Rotas do Navbar
Route::get('contatos', [App\Http\Controllers\HomeController::class, 'contatos'])->name('contatos');
Route::get('perguntas-frequentes', [App\Http\Controllers\HomeController::class, 'perguntas_frequentes'])->name('perguntas-frequentes');
Route::get('utilizacao-pagamento-resolucoes', [App\Http\Controllers\HomeController::class, 'utilizacao_do_pagamento_de_resolucoes'])->name('utilizacao-pagamento-resolucoes');
Route::get('outros-sistemas', [App\Http\Controllers\HomeController::class, 'outros_sistemas'])->name('outros-sistemas');