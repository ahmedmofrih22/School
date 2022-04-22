<?php


namespace App\Repository;

use App\Http\Requests\StoreFeeRequest;
use App\Models\Fee;
use App\Models\Grade;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;

class FeeRepository implements FeeRepositoryInterface
{

    /// index
    public function index()
    {
        $Fee = Fee::all();
        return view('pages.Fee.index', compact('Fee'));
    }


    /// Create
    public function Create()
    {
        $Grade = Grade::all();
        return view('pages.Fee.add', compact('Grade'));
    }

    ////store_fee
    public function store_fee($request)
    {
        // return $request;

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

    //edit
    public function edit($id)
    {

        $Fees = Fee::find($id);
        $Grades = Grade::all();
        return view('pages.Fee.edit', compact('Fees', 'Grades'));
    }


    public function updata($request)
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

    ///// destore
    public function destore($request)
    {

        Fee::destroy($request->id);
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('Fee.index');
    }
}
