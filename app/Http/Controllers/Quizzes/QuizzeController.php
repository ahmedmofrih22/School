<?php

namespace App\Http\Controllers\Quizzes;

use App\Http\Controllers\Controller;
use App\Repository\QuizzeRepositoryInterface;
use Illuminate\Http\Request;

use App\Models\Grade;
use App\Models\Quizze;
use App\Models\Subject;
use App\Models\Teacher;

class QuizzeController extends Controller
{

    // protected $Quizz;
    // //__construct
    // public function __construct(QuizzeRepositoryInterface $Quizz)
    // {
    //     $this->Quizz = $Quizz;
    // }


    //// index
    public function index()
    {
        $quizzes =  Quizze::all();
        return view('pages.Quizzes.index', compact('quizzes'));
    }

    //create
    public function create()
    {
        $data['grades'] = Grade::all();
        $data['teachers'] = Teacher::all();
        $data['subjects'] = Subject::all();

        return view('pages.Quizzes.create', $data);
    }

    //stroe
    public function store(Request $request)
    {
        try {
            $quizz = new Quizze();
            $quizz->name = ['ar' => $request->Name_ar, 'en' => $request->Name_en];
            $quizz->subject_id = $request->subject_id;
            $quizz->teacher_id = $request->teacher_id;
            $quizz->Grade_id = $request->Grade_id;
            $quizz->Classroom_id = $request->Classroom_id;
            $quizz->section_id = $request->section_id;
            $quizz->save();



            toastr()->success(trans('messages.success'));
            return redirect()->route('Quizzes.index');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    //edit
    public function edit($id)
    {
        $quizz = Quizze::findorFail($id);
        $data['grades'] = Grade::all();
        $data['teachers'] = Teacher::all();
        $data['subjects'] = Subject::all();

        return view('pages.Quizzes.edit', $data, compact('quizz'));
    }



    //update
    public function update(Request $request)
    {
        try {

            $quizz = Quizze::findorFail($request->id);
            $quizz->name = ['ar' => $request->Name_ar, 'en' => $request->Name_en];
            $quizz->subject_id = $request->subject_id;
            $quizz->teacher_id = $request->teacher_id;
            $quizz->Grade_id = $request->Grade_id;
            $quizz->Classroom_id = $request->Classroom_id;
            $quizz->section_id = $request->section_id;

            $quizz->save();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('Quizzes.index');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    //destroy
    public function destroy(Request $request)
    {
        try {

            Quizze::destroy($request->id);
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('Quizzes.index');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
