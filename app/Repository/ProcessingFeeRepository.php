<?php


namespace App\Repository;

use App\Models\ProcessingFee;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ProcessingFeeRepository implements ProcessingFeeRepositoryInterface
{
    public function index()
    {
        $ProcessingFees = ProcessingFee::all();
        return view('pages.ProcessingFee.index', compact('ProcessingFees'));
    }

    public function show($id)
    {
        $student = Student::find($id);
        return view('pages.ProcessingFee.add', compact('student'));
    }

    public function edit($id)
    {
        $ProcessingFee = ProcessingFee::findorfail($id);
        return view('pages.ProcessingFee.edit', compact('ProcessingFee'));
    }

    public function store($request)
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

    public function update($request)
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

    public function destroy($request)
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
