<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentsRequest;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\promotion;
use App\Models\Section;
use App\Models\Student;
use App\Models\Type_Blood;

use Illuminate\Support\Facades\Storage;
use App\Repository\StudentRepositoryInterface;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    // protected $Student;


    // //__construct
    // public function __construct(StudentRepositoryInterface $Student)
    // {
    //     $this->Student = $Student;
    // }


    //index
    public function index()
    {
        $students = Student::all();

        return view('pages.Students.index', compact('students'));
    }

    //create
    public function create()
    {
        $data['my_classes'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Type_Blood::all();
        return view('pages.Students.add', $data);
    }

    //store
    public function store(StoreStudentsRequest $request)
    {
        DB::beginTransaction();

        try {
            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();
            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as  $file) {

                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/students/' . $students->name, $file->getClientOriginalName(), 'upload_attachments');
                    $image = new Image();
                    $image->filename = $name;
                    $image->imageable_id = $students->id;
                    $image->imageable_type = 'App\Models\student';
                    $image->save();
                };
            }

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Students.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    //show

    public function show($id)
    {
        $Student = Student::findOrFail($id);
        return view('pages.Students.show',  compact('Student'));
    }


    //edit
    public function edit($id)
    {
        $data['my_classes'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Grades'] = Grade::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Type_Blood::all();
        $Students = Student::findOrFail($id);
        return view('pages.Students.edit', $data, compact('Students'));
    }

    //update
    public function update(StoreStudentsRequest  $request)
    {
        try {
            $students = Student::findOrFail($request->id);
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();



            toastr()->success(trans('messages.Update'));
            return redirect()->route('Students.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    //destroy

    public function destroy(Request $request, $id)
    {
        Student::destroy($request->id);
        //  $Teachers = Student::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));

        return redirect()->route('Students.index');
    }

    //Get_classrooms
    public function Get_classrooms($id)
    {

        $List_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
        return $List_classes;
    }


    //Get_Sections
    public function Get_Sections($id)
    {
        $List_Sections = Section::where("Class_id", $id)->pluck("Name_Section", "id");
        return $List_Sections;
    }


    //Upload_attachment
    public function Upload_attachment(Request $request)
    {

        foreach ($request->file('photos') as $file) {
            $name = $file->getClientOriginalName();
            $file->storeAs('attachments/students/' . $request->student_name, $file->getClientOriginalName(), 'upload_attachments');
            $image = new Image();
            $image->filename = $name;
            $image->imageable_id = $request->student_id;
            $image->imageable_type = 'App\Models\student';
            $image->save();
        }
        toastr()->success(trans('messages.success'));
        return redirect()->route('Students.show', $request->student_id);
    }


    //Download_attachment
    public function Download_attachment($studentsname, $filename)
    {
        return response()->download(public_path('attachments/students/' . $studentsname . '/' . $filename));
    }


    //Delete_attachment
    public function Delete_attachment(Request  $request)
    {
        Storage::disk('upload_attachments')->delete('attachments/students/' . $request->student_name . '/' . $request->filename);
        Image::where('id', $request->id)->where('filename', $request->filename)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Students.show', $request->student_id);
    }


    //aad_Graduated
    public function aad_Graduated(Request  $request)
    {
        DB::beginTransaction();
        try {

            $students =  Student::where('Grade_id', $request->Grade_id)->where('Classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->get();
            //if
            if ($students->count() < 1) {
                return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
            }
            //forech



            Student::where('id', $request->id)->Delete();
            promotion::where('student_id', $request->id)->Delete();

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Graduated.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
