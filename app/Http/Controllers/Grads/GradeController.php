<?php

namespace App\Http\Controllers\Grads;



use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrades;
use App\Models\Grade;

use Illuminate\Http\Request;
use App\Models\Classroom;
use CodeZero\UniqueTranslation\UniqueTranslationRule;


class GradeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {

        $Grades = Grade::all();


        return view('pages.Grades.Grades', compact('Grades'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreGrades $request)
    {
        // if (Grade::where('Name->ar', $request->Name)->orwhere('Name->en', $request->Name_an)->exists()) {
        //   //return redirect()->back()->withErrors(trans('Grades_trans.exists'));
        //   toastr()->error(trans('Grades_trans.exists'));

        //   return redirect()->route('Grades.index');
        // }


        try {

            $validated = $request->validated();

            $Grade = new Grade();
            /*
      حل اخر لي الغتين
          $translations = [
            'en' => $request->Name_en,
            'ar' => $request->Name
          ];

          $Grade->setTranslations('Name', $translations);
      */

            $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
            $Grade->Notes = $request->Notes;
            $Grade->save();
            toastr()->success(trans('messages.success'));

            return redirect()->route('Grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(StoreGrades $request)
    {
        try {

            $validated = $request->validated();
            $Grades = Grade::findOrFail($request->id);
            $Grades->update([
                $Grades->Name = ['ar' => $request->Name, 'en' => $request->Name_en],
                $Grades->Notes = $request->Notes,
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $checkdelete = Classroom::where('Grade_id', $request->id)->pluck('Grade_id');
        if ($checkdelete->count() == 0) {
            $Grades = Grade::findOrFail($request->id)->delete();
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('Grades.index');
        } else {
            toastr()->error(trans('messages.linked'));
            return redirect()->route('Grades.index');
        }
    }
}
