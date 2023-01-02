<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Index\Index;
use App\Http\Livewire\Post\Post;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Login;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\User\Panel as UserPanel;
use App\Http\Livewire\Admin\Panel as AdminPanel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',Index::class)->name('home');
Route::get('register',Register::class)->middleware('guest')->name('register');
Route::get('login',Login::class)->middleware('guest')->name('login');
Route::get('logout',function(){Auth::logout();return redirect('/');})->name('logout');
Route::get('post/{slug}',Post::class);


Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('user/panel', UserPanel::class)->name('user.panel');
});
  

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('admin/panel', AdminPanel::class)->name('admin.panel');
});
  