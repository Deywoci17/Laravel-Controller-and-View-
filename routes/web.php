<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


Route::get('/', function () {
    return view('welcome');
});

Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('profile', [ProfileController::class, '__invoke'])->name('profile');
Route::resource('employees', EmployeeController::class);

Auth::routes();

Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/local-disk', function () {
    Storage::disk('local')->put('local-example.txt', 'This is local example content');
    return asset('storage/local-example.txt');
});

Route::get('/public-disk', function () {
    Storage::disk('public')->put('public-example.txt', 'This is public example content');
    return asset('storage/public-example.txt');
});

Route::get('/retrieve-local-file', function () {
    return Storage::disk('local')->exists('local-example.txt') ? Storage::disk('local')->get('local-example.txt') : 'File does not exist';
});

Route::get('/download-public-file', function () {
    return Storage::download('public/public-example.txt', 'public file');
});

Route::get('/file-url', function () {
    return Storage::url('local-example.txt');
});

Route::get('/file-size', function () {
    return Storage::size('local-example.txt');
});

Route::get('/file-path', function () {
    return Storage::path('local-example.txt');
});

Route::post('/upload-example', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'avatar' => 'required|file|mimes:jpeg,png,jpg|max:2048'
    ]);
    $path = $request->file('avatar')->store('public/uploads');
    return response()->json([
        'message' => 'File uploaded successfully',
        'file_url' => Storage::url($path),
    ]);
});

Route::get('/delete-local-file', function () {
    Storage::disk('local')->delete('local-example.txt');
    return 'Deleted';
});

Route::get('/delete-public-file', function () {
    Storage::disk('public')->delete('public-example.txt');
    return 'Deleted';
});

Route::get('download-file/{employeeId}', [EmployeeController::class, 'downloadFile'])->name('employees.downloadFile');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');
