<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

// Route::get('/', function () {
//     return redirect()->route('items.index');
// });

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

Route::resource('/items', ItemController::class);//Itemのリソースコントローラ

Route::get('/user_info/create', [UserController::class, 'create'])->name('user_info.create');

Route::get('/mycart/items', [CartController::class, 'index'])->name('mycart_items.index');

Route::post('/mycart/items/{item}', [CartController::class, 'store'])->name('mycart_item.store');

Route::get('/order/history', [OrderController::class, 'history'])->name('order.history');

Route::get('/sales/history', [OrderController::class, 'history'])->name('sales.history');

Route::get('/user_password/edit', [OrderController::class, 'history'])->name('user_password.edit');