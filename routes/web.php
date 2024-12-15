<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\MailingListController;
use App\Http\Controllers\UserListController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/email/send', [EmailController::class, 'sendEmail']);
Route::get('/email/logs', [EmailLogController::class, 'index']);

Route::resource('mailing-lists', MailingListController::class);
Route::get('/email/logs', [EmailLogController::class, 'index'])->name('email.logs');

Route::get('/emails/send', [EmailController::class, 'showSendEmailForm'])->name('emails.form');
Route::post('/emails/send', [EmailController::class, 'send'])->name('emails.send');


Route::resource('user-lists', UserListController::class);

use App\Http\Controllers\UserController;

// Ruta para mostrar todos los usuarios
Route::get('users', [UserController::class, 'index'])->name('users.index');

// Ruta para mostrar el formulario de creación de un nuevo usuario
Route::get('users/create', [UserController::class, 'create'])->name('users.create');

// Ruta para almacenar un nuevo usuario
Route::post('users', [UserController::class, 'store'])->name('users.store');