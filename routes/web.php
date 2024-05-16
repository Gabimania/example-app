<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ImageController;

Route::get('/', function () {
    return view('ceica');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('students', StudentController::class);
    Route::resource('cars', CarController::class);
    Route::get('/imagecars/{image}', function($image) {
        $path = storage_path('app\\resources\\images\\' . $image);
        
        if (!file_exists($path)) {
            abort(404);
        }
    
        return response()->file($path, ['Content-Type' => 'image/jpeg']);
        /*
        $images=new ImageController();
    
        return $images->show($image);
        */
    })->name("imagecars");
});

//Route::get('imagecars/{image}', [ImageController::class, 'show'])->name('imagecars.show');
//ruta para el controller Student


require __DIR__ . '/auth.php';
