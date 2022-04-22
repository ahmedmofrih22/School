<?php

namespace App\Http\Controllers\Subjects;

use App\Http\Controllers\Controller;
use App\Repository\SubjectRepositoryInterface;
use Illuminate\Http\Request;
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

class SubjectController extends Controller
{

    // protected $Subject;
    // //__construct
    // public function __construct(SubjectRepositoryInterface $Subject)
    // {
    //     $this->Subject = $Subject;
    // }


    //// index
    public function index()
    {
        $subjects = Subject::get();
        return view('pages.Subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Subjects.create', compact('grades', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Subjects.edit', compact('subject', 'grades', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Subject::destroy($request->id);
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('subjects.index');
    }
}
