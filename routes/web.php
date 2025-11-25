<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Employee;

Route::get('/', function () {
    return view('users.index');
});
Route::get('/adm', function () {
    return view('admin.dashboard');
});
Route::get('/allusers', function () {
    return view('admin.allusers');
});
//User Middleware
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
       if(Auth::user()->role == "Admin")
       {
          return view('admin.dashboard');
       }
       else if(Auth::user()->role == "Employee")
       {
        return response()->json("Employee Dashboard is Under Maintenance");
       }
       else
       {
        return redirect('/');
       }
    })->name('dashboard');
});
//Admin Middleware
Route::middleware([Admin::class])->group(function(){


});
//Employee Middleware
Route::middleware([Admin::class])->group(function(){

    
});