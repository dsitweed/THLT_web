<?php

use App\Models\Course;
use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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
    return view('test');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('index');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
/* Phần trên là mặc định của laravel và Breeze  */


Route::get('/',[ListingController::class, 'index']);

Route::get('/listings/{listing}', [ListingController::class,'show']);

Route::get('/home', [HomeController::class, 'index']);


Route::resource('/examinfo', ExaminfoController::class);
Route::post('/examinfo/store-random-exam', [ExaminfoController::class, 'storeRandomExam']);
Route::resource('/makequestion', QuestionController::class);
Route::resource('/answer', AnswerController::class);
Route::resource('/result', ResultController::class);

// Cách tương đương nhưng viết như này hơi dài và gộp lại thành cách dưới 
// Route::get('teacher/show-all-exams', [TeacherController::class, 'showAllExams'])->name('teacher.show-all-exams');
// Route::get('teacher/create-new-exam', [TeacherController::class, 'createNewExam'])->name('teacher.create-new-exam');



Route::controller(StudentController::class)->group(function () {
    Route::get('student/show-all-exams', 'showAllExams')->name('student.show-all-exams');
    Route::get('student/do-exam/{exam_id}', 'doExam')->name('student.do-exam');
    Route::get('student/join-course', 'joinCourse')->name('student.join-course');
    Route::post('student/join-course', 'joinCourseSave');
    Route::post('student/join-course-private', 'joinCoursePrivateSave');
});


Route::controller(TeacherController::class)->group(function () {
    Route::get('teacher/show-all-exams', 'showAllExams')->name('teacher.show-all-exams');
    Route::get('teacher/show-student-result/{exam_id}', 'showStudentResult')->name('teacher.show-student-result');
    Route::post('teacher/show-student-result-detail', 'showStudentResultDetail')->name('teacher.show-student-result-detail');
    Route::get('teacher/show-forum', 'showForum')->name('teacher.show-forum');
});

Route::controller(CourseController::class)->group(function () {
    Route::get('course/', 'index')->name('course.index');
    Route::get('course/create', 'create')->name('course.create');
    Route::get('course/forum/{course_id}', 'showCourseForum')->name('course.forum');
    Route::post('course/store', 'store')->name('course.store');
});

Route::controller(PostController::class)->group(function () {
    Route::post('post/store', 'store')->name('post.store');
    Route::post('post/storeReply', 'storeReply')->name('post.storeReply');

    // Thao tác với like
    Route::post('post/add-like', 'addLikePost')->name('post.add-like');
    Route::post('post/remove-like', 'removeLikePost')->name('post.remove-like');

});

/*
Ex: Route::resource('photos', PhotoController::class);
Dùng resource thì nó sẽ đặt tên cho route luôn khi mình dùng route('student.index') chẳng hạn sẽ tiện (hơi khó hiểu 1 tí)
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