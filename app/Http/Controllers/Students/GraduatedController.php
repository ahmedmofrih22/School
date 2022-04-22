<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\StudentGraduatedRepositoryInterface;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;
use App\Models\Grade;
use App\Models\promotion;
use App\Models\Student;
use GuzzleHttp\Promise\Promise;
use Illuminate\Support\Facades\DB;

class GraduatedController extends Controller
{

    // protected $Graduated;


    // //__construct
    // public function __construct(StudentGraduatedRepositoryInterface $Graduated)
    // {
    //     $this->Graduated = $Graduated;
    // }




    //index
    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('pages.Students.Graduated.index', compact('students'));
    }



    //create
    public function create()
    {
        $Grades = Grade::all();
        return view('pages.Students.Graduated.create', compact('Grades'));
    }



    //store
    public function store(Request $request)
    {


        $students =  Student::where('Grade_id', $request->Grade_id)->where('Classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->get();
        //if
        if ($students->count() < 1) {
            return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
        }
        //forech

        foreach ($students  as  $student) {
            $ids = explode(',', $student->id);
            Student::whereIn('id', $ids)->Delete();
        }

        toastr()->success(trans('messages.success'));
        return redirect()->route('Graduated.index');
    }





    ///update
    public function update(Request $request, $id)
    {
        Student::onlyTrashed()->where('id', $request->id)->first()->restore();
        promotion::onlyTrashed()->where('student_id', $request->id)->first()->restore();

        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }


    ///destroy
    public function destroy(Request $request)
    {
        Student::onlyTrashed()->where('id', $request->id)->first()->forceDelete();

        toastr()->success(trans('messages.Delete'));
        return redirect()->back();
    }


    //det
    public function det(Request $request)
    {

        $students =  Student::findOrFail($request->id);

        if ($students->count() < 1) {

            return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
        }




        promotion::where('id', $request->id)->Delete();


        toastr()->success(trans('messages.success'));
        return redirect()->route('Graduated.index');
    }
}
