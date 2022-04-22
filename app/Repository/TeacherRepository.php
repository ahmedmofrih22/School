<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface
{
    //getAllTeachers
    public function getAllTeachers()
    {
        return Teacher::all();
    }


    // Getspecializations
    public function Getspecializations()
    {
        return  Specialization::all();
    }

    // GetGender
    public function GetGender()
    {
        return Gender::all();
    }


    // GetGender
    public function StoreTeacher($request)
    {
        try {
            //$validated = $request->validated();

            $Teachers = new Teacher();
            $Teachers->Email = $request->Email;
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

    public function EditTeacher($id)
    {
        return Teacher::findOrFail($id);
    }

    public function updateTeacher($request)
    {
        try {
            //$validated = $request->validated();
            $Teachers = Teacher::findOrFail($request->id);

            $Teachers->Email = $request->Email;
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


    public function deleteTeacher($request)
    {
        $Teachers = Teacher::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));

        return redirect()->route('Teachers.index');
    }
}
