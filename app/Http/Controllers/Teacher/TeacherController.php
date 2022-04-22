<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeachers;
use App\Models\Gender;
use Illuminate\Http\Request;
use App\Repository\TeacherRepositoryInterface;
use App\Models\Specialization;

use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{


    // protected $Teacher;

    // public function __construct(TeacherRepositoryInterface $Teacher)
    // {
    //     $this->Teacher = $Teacher;
    // }

    /////index
    public function index()
    {
        $Teachers = Teacher::all();;
        return view('pages.Teachers.Teachers', compact('Teachers'));
    }

    /////create
    public function create()
    {
        $specializations = Specialization::all();
        $genders = Gender::all();

        return view('pages.Teachers.create', compact('specializations', 'genders'));
    }


    /////store
    public function store(StoreTeachers $request)
    {


        try {

            $Teachers = new Teacher();
            $Teachers->email = $request->email;
            $Teachers->password = Hash::make($request->password);

            $Teachers->Name = ['ar' => $request->Name_ar, 'en' => $request->Name_en];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;

            $Teachers->save();
            toastr()->success(trans('messages.success'));

            return redirect()->route('Teachers.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /////edit

    public function edit($id)
    {
        $specializations = Specialization::all();
        $genders = Gender::all();
        $Teachers = Teacher::findOrFail($id);
        return view('pages.Teachers.Edit', compact('Teachers', 'specializations', 'genders'));
    }


    /////update
    public function update(StoreTeachers $request)
    {
        try {
            //$validated = $request->validated();
            $Teachers = Teacher::findOrFail($request->id);

            $Teachers->email = $request->email;
            $Teachers->password = Hash::make($request->password);

            $Teachers->Name = ['ar' => $request->Name_ar, 'en' => $request->Name_en];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;

            $Teachers->save();
            toastr()->success(trans('messages.Update'));

            return redirect()->route('Teachers.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /////destroy
    public function destroy(Request $request)
    {
        $Teachers = Teacher::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));

        return redirect()->route('Teachers.index');
    }
}
