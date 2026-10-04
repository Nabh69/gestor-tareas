<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PortfolioController;


/*
|--------------------------------------------------------------------------
| PÁGINA PRINCIPAL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');

});


/*
|--------------------------------------------------------------------------
| USUARIOS NO AUTENTICADOS
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.process');

});


/*
|--------------------------------------------------------------------------
| USUARIOS AUTENTICADOS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('tasks', TaskController::class)
        ->except(['show']);

    Route::patch(
        '/tasks/{task}/toggle',
        [TaskController::class, 'toggle']
    )->name('tasks.toggle');

    Route::resource('projects', ProjectController::class)
        ->only([
            'index',
            'show',
            'store',
            'destroy'
        ]);

Route::resource('portfolios', PortfolioController::class)
    ->only([
        'index',
        'show',
        'store',
        'destroy'
    ]);

Route::patch(
    '/portfolios/{portfolio}/projects',
    [PortfolioController::class, 'updateProjects']
)->name('portfolios.projects.update');

    Route::post(
        '/logout',
        [AuthController::class, 'logout']
    )->name('logout');
});