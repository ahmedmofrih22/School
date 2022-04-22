<?php


namespace App\Repository;

use App\Models\Fee;
use App\Models\Fee_invoice;
use App\Models\FundAccount;
use App\Models\Grade;
use App\Models\PaymentStudent;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class PaymentStudentRepository implements PaymentStudentRepositoryInterface
{


    //index
    public function index()
    {
        $payment_students = PaymentStudent::all();
        return view('pages.Payment.index', compact('payment_students'));
    }

    //show
    public function show($id)

    {
        $student = Student::findorfail($id);
        return view('pages.Payment.add', compact('student'));
    }


    ////edit
    public function edit($id)
    {
        $payment_student = PaymentStudent::findorfail($id);
        return view('pages.Payment.edit', compact('payment_student'));
    }



    ///store
    public function store($request)
    {
        DB::beginTransaction();
        try {

            // PaymentStudent حفظ في جدول
            $Payment = new PaymentStudent();
            $Payment->date = date('Y-m-d');
            $Payment->student_id = $request->student_id;
            $Payment->amount = $request->Debit;
            $Payment->description = $request->description;
            $Payment->save();


            // FundAccountحفظ  في جدول
            $FundAccount = new FundAccount();
            $FundAccount->date = date('Y-m-d');
            $FundAccount->payment_id = $Payment->id;
            $FundAccount->Debit = '0.00';
            $FundAccount->credit = $request->Debit;
            $FundAccount->description = $request->description;
            $FundAccount->save();

            //حفظ في جدول studentAccount
            $StudentAccount = new StudentAccount();
            $StudentAccount->date = date('Y-m-d');
            $StudentAccount->type = 'Payment';
            $StudentAccount->student_id = $request->student_id;
            $StudentAccount->payment_id = $Payment->id;
            $StudentAccount->Debit = $request->Debit;
            $StudentAccount->credit = '0.00';
            $StudentAccount->description = $request->description;
            $StudentAccount->save();

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Payment_students.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    ///updata
    public function updata($request)
    {

        DB::beginTransaction();
        try {

            // PaymentStudent حفظ في جدول
            $Payment = PaymentStudent::findorfail($request->id);
            $Payment->date = date('Y-m-d');
            $Payment->student_id = $request->student_id;
            $Payment->amount = $request->Debit;
            $Payment->description = $request->description;
            $Payment->save();


            // FundAccountحفظ  في جدول
            $FundAccount =  FundAccount::where('payment_id', $request->id)->first();
            $FundAccount->date = date('Y-m-d');
            $FundAccount->payment_id = $Payment->id;
            $FundAccount->Debit = '0.00';
            $FundAccount->credit = $request->Debit;
            $FundAccount->description = $request->description;
            $FundAccount->save();

            //حفظ في جدول studentAccount
            $StudentAccount =  StudentAccount::where('payment_id', $request->id)->first();
            $StudentAccount->date = date('Y-m-d');
            $StudentAccount->type = 'Payment';
            $StudentAccount->student_id = $request->student_id;
            $StudentAccount->payment_id = $Payment->id;
            $StudentAccount->Debit = $request->Debit;
            $StudentAccount->credit = '0.00';
            $StudentAccount->description = $request->description;
            $StudentAccount->save();

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Payment_students.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            PaymentStudent::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
