<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeeRequest;
use App\Models\Fee;
use App\Models\Student;
use App\Repository\FeeRepositoryInterface;
use Illuminate\Http\Request;

use App\Models\Grade;
use Illuminate\Support\Facades\Hash;

class FeeController extends Controller
{

    // protected $Fee;
    // //__construct
    // public function __construct(FeeRepositoryInterface $Fee)
    // {
    //     $this->Fee = $Fee;
    // }


    //// index
    public function index()
    {
        $Fee = Fee::all();
        return view('pages.Fee.index', compact('Fee'));
    }


    ///create
    public function create()
    {
        $Grade = Grade::all();
        return view('pages.Fee.add', compact('Grade'));
    }



    ///store
    public function store(Request $request)
    {
        try {
            $Fee = new Fee();
            $Fee->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $Fee->amount = $request->amount;


            $Fee->Grade_id = $request->Grade_id;
            $Fee->Fee_Type = $request->Fee_Type;
            $Fee->Classroom_id = $request->Classroom_id;

            $Fee->description = $request->description;
            $Fee->year = $request->year;
            $Fee->save();



            toastr()->success(trans('messages.success'));
            return redirect()->route('Fee.index');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    //show
    public function show($id)
    {

        $Fee = Fee::where('id', $id)->first();
        $g = $Fee->Grade_id;
        $C = $Fee->Classroom_id;

        $students = Student::where('Classroom_id', $C)->where('Grade_id', $g)->get();
        return view('pages.Fee.Show', compact('students'));
    }



    ///edit
    public function edit($id)
    {
        $Fees = Fee::find($id);
        $Grades = Grade::all();
        return view('pages.Fee.edit', compact('Fees', 'Grades'));
    }




    ///update
    public function update(Request $request)
    {
        try {
            $Fee =  Fee::find($request->id);
            $Fee->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $Fee->amount = $request->amount;


            $Fee->Grade_id = $request->Grade_id;
            $Fee->Classroom_id = $request->Classroom_id;
            $Fee->Fee_Type = $request->Fee_Type;
            $Fee->description = $request->description;
            $Fee->year = $request->year;
            $Fee->save();



            toastr()->success(trans('messages.Update'));
            return redirect()->route('Fee.index');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    //destroy
    public function destroy(Request $request)
    {

        Fee::destroy($request->id);
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('Fee.index');
    }
}
