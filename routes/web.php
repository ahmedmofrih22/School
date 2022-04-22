<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

//Auth::routes();

// Route::group(['middleware' => ['guest']], function () {

//     Route::get('/', function () {
//         return view('auth.login');
//     });
// });

Route::get('/', 'HomeController@index')->name('selection');


Route::group(['namespace' => 'Auth'], function () {

    Route::get('/login/{type}', 'LoginController@loginForm')->middleware('guest')->name('login.show');

    Route::post('/login', 'LoginController@login')->name('login');
    Route::get('/logout/{type}', 'LoginController@logout')->name('logout');
});


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ],
    function () {


        Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

        ///////////////////////////// Grads //////////////////////////////////////
        Route::group(['namespace' => 'Grads'], function () {
            Route::resource('Grades', 'GradeController');
        });

        ///////////////////////////// Classrooms //////////////////////////////////////

        Route::group(['namespace' => 'Classrooms'], function () {
            Route::resource('Classrooms', 'ClassroomController');
            Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
            Route::post('serch', 'ClassroomController@serch')->name('serch');
        });


        ///////////////////////////// Section //////////////////////////////////////
        Route::group(['namespace' => 'Sections'], function () {

            Route::resource('Sections', 'SectionController');

            Route::get('/classes/{id}', 'SectionController@getclasses');
        });

        ///////////////////////////// livewire //////////////////////////////////////


        Route::view('add_parent', 'livewire.show_Form')->name('add_parent');


        ///////////////////////////// Teacher //////////////////////////////////////

        Route::group(['namespace' => 'Teacher'], function () {

            Route::resource('Teachers', 'TeacherController');
        });

        ///////////////////////////// Students //////////////////////////////////////

        Route::group(['namespace' => 'Students'], function () {

            Route::resource('Students', 'StudentController');
            Route::resource('Promotion', 'PromotionController');
            Route::resource('Graduated', 'GraduatedController');
            Route::resource('Fee', 'FeeController');
            Route::resource('Fees_Invoices', 'FeesInvoicesController');
            Route::resource('receipt_students', 'ReceiptStudentController');
            Route::resource('ProcessingFee', 'ProcessingFeeController');
            Route::resource('Payment_students', 'PaymentStudentController');
            Route::resource('Attendance', 'AttendanceController');
            Route::resource('online_classes', 'OnlineClasseController');
            Route::resource('library', 'LibraryController');
            Route::get('download_file/{filename}', 'LibraryController@downloadAttachment')->name('downloadAttachment');
            Route::get('/indirect', 'OnlineClasseController@indirectcreate')->name('indirect');
            Route::post('indirect', 'OnlineClasseController@indirectstore')->name('indirect');
            Route::get('/Get_classrooms/{id}', 'StudentController@Get_classrooms');
            Route::get('/Get_Amount/{id}', 'FeesInvoicesController@Get_Amount');
            Route::post('aad_Graduated', 'StudentController@aad_Graduated')->name('aad_Graduated');
            Route::post('det', 'GraduatedController@det')->name('det');
            Route::get('/Get_Sections/{id}', 'StudentController@Get_Sections');
            Route::post('Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
            Route::post('Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');
            Route::get('Download_attachment/{studentsname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
        });



        Route::group(['namespace' => 'Subjects'], function () {

            Route::resource('subjects', 'SubjectController');
        });


        Route::group(['namespace' => 'Quizzes'], function () {

            Route::resource('Quizzes', 'QuizzeController');
        });

        Route::group(['namespace' => 'Questions'], function () {

            Route::resource('questions', 'QuestionController');
        });


        Route::resource('settings', 'SettingController');
    }

);
