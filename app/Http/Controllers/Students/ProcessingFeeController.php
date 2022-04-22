<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\ProcessingFeeRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\ProcessingFee;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ProcessingFeeController extends Controller
{
    // protected $Processing;


    // ///__construct
    // public function __construct(ProcessingFeeRepositoryInterface $Processing)
    // {
    //     $this->Processing = $Processing;
    // }


    //index
    public function index()
    {
        $ProcessingFees = ProcessingFee::all();
        return view('pages.ProcessingFee.index', compact('ProcessingFees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // حفظ في جدول processing_fees

            $processing = new ProcessingFee();

            $processing->date = date('Y-m-d');
            $processing->student_id = $request->student_id;
            $processing->amount = $request->Debit;
            $processing->description = $request->description;
            $processing->save();


            //حفظ في جدول student_accounts

            $studentAccounts = new StudentAccount();
            $studentAccounts->date = date('Y-m-d');
            $studentAccounts->type = 'processingFees';
            $studentAccounts->student_id = $request->student_id;
            $studentAccounts->processing_id =  $processing->id;
            $studentAccounts->Debit =  '0.00';
            $studentAccounts->credit  =  $request->Debit;
            $studentAccounts->description = $request->description;
            $studentAccounts->save();
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('ProcessingFee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        return view('pages.ProcessingFee.add', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ProcessingFee = ProcessingFee::findorfail($id);
        return view('pages.ProcessingFee.edit', compact('ProcessingFee'));
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

        DB::beginTransaction();
        try {
            // تعديل في جدول processing_fees

            $processing = ProcessingFee::findorfail($request->id);

            $processing->date = date('Y-m-d');
            $processing->student_id = $request->student_id;
            $processing->amount = $request->Debit;
            $processing->description = $request->description;
            $processing->save();


            //تعديل في جدول student_accounts

            $studentAccounts = StudentAccount::where('processing_id', $request->id)->first();
            $studentAccounts->date = date('Y-m-d');
            $studentAccounts->type = 'processingFees';
            $studentAccounts->student_id = $request->student_id;
            $studentAccounts->processing_id =  $processing->id;
            $studentAccounts->Debit =  '0.00';
            $studentAccounts->credit  =  $request->Debit;
            $studentAccounts->description = $request->description;
            $studentAccounts->save();
            DB::commit();
            toastr()->success(trans('messages.Updata'));
            return redirect()->route('ProcessingFee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {

            ProcessingFee::destroy($request->id);



            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
