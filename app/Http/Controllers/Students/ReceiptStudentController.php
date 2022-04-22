<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\FundAccount;
use App\Models\ReceiptStudent;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Repository\ReceiptStudentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptStudentController extends Controller
{
    // protected $Receipt;


    // //__construct
    // public function __construct(ReceiptStudentRepositoryInterface $Receipt)
    // {
    //     $this->Receipt = $Receipt;
    // }


    ////index
    public function index()
    {
        $receipt_students = ReceiptStudent::all();
        return view('pages.Receipt.index', compact('receipt_students'));
    }



    ///store
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {
            ///  ReceiptStudentا حفظ في جدول
            $ReceiptStudent = new  ReceiptStudent();
            $ReceiptStudent->date = date('Y-m-d');
            $ReceiptStudent->student_id = $request->student_id;
            $ReceiptStudent->Debit = $request->Debit;
            $ReceiptStudent->description = $request->description;

            $ReceiptStudent->save();


            /// FundAccount حفظ  في جدول

            $FundAccount = new FundAccount();

            $FundAccount->date = date('Y-m-d');
            $FundAccount->receipt_id =  $ReceiptStudent->id;
            $FundAccount->Debit = $request->Debit;
            $FundAccount->description = $request->description;
            $FundAccount->credit = '0.00';

            $FundAccount->save();


            ///student_accounts حقظ في جدول

            $student_accounts = new StudentAccount();
            $student_accounts->date = date('Y-m-d');
            $student_accounts->type = 'Receipt';
            $student_accounts->student_id   =  $request->student_id;
            $student_accounts->receipt_id =  $ReceiptStudent->id;

            $student_accounts->Debit = '0.00';
            $student_accounts->description = $request->description;
            $student_accounts->credit = $request->Debit;
            $student_accounts->save();

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('receipt_students.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    //show
    public function show($id)
    {
        $student = Student::findorfail($id);

        return view('pages.Receipt.add', compact('student'));
    }

    //edit
    public function edit($id)
    {
        $receipt_student = ReceiptStudent::findorfail($id);

        return view('pages.Receipt.edit', compact('receipt_student'));
    }

    ///update
    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            ///  ReceiptStudentا حفظ في جدول
            $ReceiptStudent =   ReceiptStudent::findorfail($request->id);
            $ReceiptStudent->date = date('Y-m-d');
            $ReceiptStudent->student_id = $request->student_id;
            $ReceiptStudent->Debit = $request->Debit;
            $ReceiptStudent->description = $request->description;

            $ReceiptStudent->save();


            /// FundAccount حفظ  في جدول

            $FundAccount = FundAccount::where('receipt_id', $request->id)->first();

            $FundAccount->date = date('Y-m-d');
            $FundAccount->receipt_id =  $ReceiptStudent->id;
            $FundAccount->Debit = $request->Debit;
            $FundAccount->description = $request->description;
            $FundAccount->credit = '0.00';

            $FundAccount->save();


            ///student_accounts حقظ في جدول

            $student_accounts = StudentAccount::where('receipt_id', $request->id)->first();
            $student_accounts->date = date('Y-m-d');
            $student_accounts->type = 'Receipt';
            $student_accounts->student_id   =  $request->student_id;
            $student_accounts->receipt_id =  $ReceiptStudent->id;

            $student_accounts->Debit = '0.00';
            $student_accounts->description = $request->description;
            $student_accounts->credit = $request->Debit;
            $student_accounts->save();

            DB::commit();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('receipt_students.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    ///destory
    public function destroy(Request $request)
    {

        try {
            ReceiptStudent::destroy($request->id);
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('receipt_students.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
