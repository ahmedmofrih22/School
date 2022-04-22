<?php


namespace App\Repository;

use App\Models\Attendance;
use App\Models\Fee;
use App\Models\Fee_invoice;
use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class AttendanceRepository implements AttendanceRepositoryInterface
{


    //index
    public function index()
    {
        $Grades = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();
        $teachers = Teacher::all();

        return view('pages.Attendance.Sections', compact('Grades', 'list_Grades', 'teachers'));
    }

    //show
    public function show($id)

    {
        $students  = Student::with(['attendance'])->where('section_id', $id)->get();
        return view('pages.Attendance.index', compact('students'));
    }


    ////edit
    public function edit($id)
    {
    }

    ///store
    public function store($request)
    {




        try {
            foreach ($request->attendences as $studentid => $attendence) {
                if ($attendence == 'presence') {
                    $attendence_status = true;
                } elseif ($attendence == 'absent') {
                    $attendence_status = false;
                }


                Attendance::create([
                    'student_id' => $studentid,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => 1,
                    'attendence_date' => date('Y-m-d'),
                    'attendence_status' => $attendence_status
                ]);
            }

            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    ///updata
    public function updata($request)
    {




        try {



            toastr()->success(trans('messages.Update'));
            return redirect()->route('Fees_Invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
    }
}
