<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ExaminfoController;
use App\Http\Controllers\QuestionController;

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

Route::get('/test', function () {
    return view('teacher.showTeacherExam');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
/* Phần trên là mặc định của laravel và Breeze  */

Route::get('/home', [HomeController::class, 'index']);


Route::resource('/examinfo', ExaminfoController::class);
Route::resource('/makequestion', QuestionController::class);
Route::resource('/student', StudentController::class);
Route::resource('/answer', AnswerController::class);
Route::resource('/result', ResultController::class);


/*
Ex: Route::resource('photos', PhotoController::class);
Actions Handled By Resource Controller
Verb	    URI	                    Action	Route Name
GET	        /photos	                index	photos.index
GET	        /photos/create	        create	photos.create
POST	    /photos	                store	photos.store
GET	        /photos/{photo}	        show	photos.show
GET	        /photos/{photo}/edit	edit	photos.edit
PUT/PATCH	/photos/{photo}	        update	photos.update
DELETE	    /photos/{photo}	        destroy	photos.destroy
*/