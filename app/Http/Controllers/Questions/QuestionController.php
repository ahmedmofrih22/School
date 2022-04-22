<?php

namespace App\Http\Controllers\Questions;

use App\Http\Controllers\Controller;
use App\Repository\QuestionRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quizze;
use App\Models\Subject;
use App\Models\Teacher;

class QuestionController extends Controller
{

    // protected $Question;
    // //__construct
    // public function __construct(QuestionRepositoryInterface $Question)
    // {
    //     $this->Question = $Question;
    // }



    //index
    public function index()
    {
        $questions =  Question::all();
        return view('pages.Questions.index', compact('questions'));
    }



    ///create
    public function create()
    {
        $quizzes = Quizze::all();
        return view('pages.Questions.create', compact('quizzes'));
    }



    //// store
    public function store(Request $request)
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


    ///edit
    public function edit($id)
    {
        $quizzes = Quizze::all();
        $question = Question::findorFail($id);
        return view('pages.Questions.edit', compact('quizzes', 'question'));
    }

    //update
    public function update(Request $request)
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



    //destroy
    public function destroy(Request $request)
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
