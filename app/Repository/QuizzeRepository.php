<?php


namespace App\Repository;

use App\Models\Grade;
use App\Models\Quizze;
use App\Models\Subject;
use App\Models\Teacher;

class QuizzeRepository implements QuizzeRepositoryInterface
{


    //index
    public function index()
    {
        $quizzes =  Quizze::all();
        return view('pages.Quizzes.index', compact('quizzes'));
    }

    //show
    public function creat()

    {
        $data['grades'] = Grade::all();
        $data['teachers'] = Teacher::all();
        $data['subjects'] = Subject::all();

        return view('pages.Quizzes.create', $data);
    }


    ////edit
    public function edit($id)
    {
        $quizz = Quizze::findorFail($id);
        $data['grades'] = Grade::all();
        $data['teachers'] = Teacher::all();
        $data['subjects'] = Subject::all();

        return view('pages.Quizzes.edit', $data, compact('quizz'));
    }

    ///store
    public function store($request)
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


    ///updata
    public function updata($request)
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

    public function destroy($request)
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
