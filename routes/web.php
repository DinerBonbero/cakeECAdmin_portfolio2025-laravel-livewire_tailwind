<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Livewire\CartItemNum;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\SalesController;

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

Route::get('/mycart/items', [CartController::class, 'index'])->name('mycart_item.index')->middleware('auth');

Route::post('/mycart/items/{item}', [CartController::class, 'store'])->name('mycart_item.store')->middleware('auth');

Route::patch('/mycart/items/{item}', [CartController::class, 'update'])->name('mycart_item.update')->middleware('auth');

Route::delete('/mycart/items/{item}', [CartController::class, 'destroy'])->name('mycart_item.destroy')->middleware('auth');

Route::get('/user_password/edit', [OrderController::class, 'history'])->name('user_password.edit')->middleware('auth');

Route::get('/user_info/create', [UserController::class, 'create'])->name('user_info.create')->middleware('auth');

Route::post('/user_info', [UserController::class, 'store'])->name('user_info.store')->middleware('auth');

Route::get('/user_info/edit', [UserController::class, 'edit'])->name('user_info.edit')->middleware('auth');

Route::patch('/user_info', [UserController::class, 'update'])->name('user_info.update')->middleware('auth');//Route::postでは上書きされてしまうためgetのeditに揃えてURLを/user_info/editにするかpostをpatchに変更する

Route::get('/order/confirm', [OrderController::class, 'confirm'])->name('order.confirm')->middleware('auth');

Route::post('/order', [OrderController::class, 'store'])->name('order.store')->middleware('auth');

Route::get('/order/thank_you', [OrderController::class, 'thankYou'])->name('order.thank_you')->middleware('auth');

Route::get('/order/history', [OrderController::class, 'history'])->name('order.history')->middleware('auth');

Route::get('/sales/history', [SalesController::class, 'history'])->name('sales.history')->middleware('auth');

Route::get('/error', [ErrorController::class, 'error'])->name('errors.error');