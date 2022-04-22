<?php


namespace App\Repository;

use App\Models\Grade;
use App\Models\Question;
use App\Models\Quizze;
use App\Models\Subject;
use App\Models\Teacher;

class QuestionRepository implements QuestionRepositoryInterface
{


    //index
    public function index()
    {
        $questions =  Question::all();
        return view('pages.Questions.index', compact('questions'));
    }

    //show
    public function creat()

    {
        $quizzes = Quizze::all();
        return view('pages.Questions.create', compact('quizzes'));
    }


    ////edit
    public function edit($id)
    {
        $quizzes = Quizze::all();
        $question = Question::findorFail($id);
        return view('pages.Questions.edit', compact('quizzes', 'question'));
    }

    ///store
    public function store($request)
    {


        try {
            $Question = new Question();
            $Question->title = $request->title;
            $Question->answers = $request->answers;
            $Question->right_answer = $request->right_answer;
            $Question->score = $request->score;
            $Question->quizze_id = $request->quizze_id;
            $Question->save();



            toastr()->success(trans('messages.success'));
            return redirect()->route('questions.index');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    ///updata
    public function updata($request)
    {
        try {

            $Question = Question::findorFail($request->id);
            $Question->title = $request->title;
            $Question->answers = $request->answers;
            $Question->right_answer = $request->right_answer;
            $Question->score = $request->score;
            $Question->quizze_id = $request->quizze_id;

            $Question->save();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('questions.index');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {

            Question::destroy($request->id);
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('questions.index');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
