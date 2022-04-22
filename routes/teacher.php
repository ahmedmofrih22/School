<?php

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/teacher/dashboard', function () {
            $ids = Teacher::findorfail(auth()->user()->id)->Sections()->pluck('section_id');
            $data['count_section'] = $ids->count();
            $data['count_student'] = Student::whereIn('section_id', $ids)->count();
            return view('pages.Teachers.dashboard.dashboard', $data);
        });

        Route::group(['namespace' => 'Teacher\dashboard'], function () {

            Route::get('Student', 'StudentController@index')->name('Student.index');
            Route::get('sections', 'StudentController@section')->name('sections');
            Route::post('attendance', 'StudentController@attendance')->name('attendance');
            Route::post('attendanceEdit', 'StudentController@attendanceEdit')->name('attendanceEdit');
            Route::post('attendance_search', 'StudentController@attendance_search')->name('attendance_search');
            Route::get('attendance_report', 'StudentController@attendance_report')->name('attendance_report');
        });
    }
);
