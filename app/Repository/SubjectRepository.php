<?php


namespace App\Repository;

use App\Models\Attendance;
use App\Models\Fee;
use App\Models\Fee_invoice;
use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class SubjectRepository implements SubjectRepositoryInterface
{


    //index
    public function index()
    {
        $subjects = Subject::get();
        return view('pages.Subjects.index', compact('subjects'));
    }

    //show
    public function creat()

    {
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Subjects.create', compact('grades', 'teachers'));
    }


    ////edit
    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Subjects.edit', compact('subject', 'grades', 'teachers'));
    }

    ///store
    public function store($request)
    {
        $Subject = new Subject();

        $Subject->name = ['ar' => $request->Name_ar, 'en' => $request->Name_en];
        $Subject->Grade_id = $request->Grade_id;
        $Subject->classroom_id = $request->classroom_id;
        $Subject->teacher_id = $request->teacher_id;
        $Subject->save();
        toastr()->success(trans('messages.success'));
        return redirect()->route('subjects.index');
    }



    ///updata
    public function updata($request)
    {
        $Subject =  Subject::findOrFail($request->id);

        $Subject->name = ['ar' => $request->Name_ar, 'en' => $request->Name_en];
        $Subject->Grade_id = $request->Grade_id;
        $Subject->classroom_id = $request->classroom_id;
        $Subject->teacher_id = $request->teacher_id;
        $Subject->save();
        toastr()->success(trans('messages.Update'));
        return redirect()->route('subjects.index');
    }

    public function destroy($request)
    {

        Subject::destroy($request->id);
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('subjects.index');
    }
}
