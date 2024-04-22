<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\TicketController;
use HubsDom\Services\HubsPotClient;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return app(HubsPotClient::class)->getContacts();
});

//CONTACTOS
Route::get('/contacts', [ContactController::class, 'list'])->name('list.contacts');
Route::get('/contact', [ContactController::class, 'filtered'])->name('filtered.contact');
Route::get('/contact/create', [ContactController::class, 'creation'])->name('creation.contact');
Route::get('/contact/update', [ContactController::class, 'update'])->name('update.contact');
Route::get('/contact/archive', [ContactController::class, 'archive'])->name('archive.contact');

//VIEW
Route::get('/home', function () {return view('createT');});
Route::get('/update', function () {return view('update');});
Route::get('/filter', function () {return view('filter');});


//CLIENTES
Route::get('/tickets', [TicketController::class, 'list'])->name('list.tickets');
Route::get('/ticket', [TicketController::class, 'filtered'])->name('filtered.ticket');
Route::get('/ticket/create', [TicketController::class, 'creation'])->name('creation.ticket');
Route::get('/ticket/update', [TicketController::class, 'update'])->name('update.ticket');
Route::get('/ticket/archive', [TicketController::class, 'archive'])->name('archive.ticket');
