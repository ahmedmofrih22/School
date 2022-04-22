<?php


namespace App\Repository;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\Library;

class libraryRepository implements libraryRepositoryInterface
{
    use AttachFilesTrait;
    //index
    public function index()
    {
        $books = Library::all();
        return view('pages.library.index', compact('books'));
    }

    //destroy
    public function create()
    {
        $grades = Grade::all();
        return view('pages.library.create', compact('grades'));
    }

    //destroy
    public function store($request)
    {
        try {
            $library = new Library();
            $library->title = $request->title;
            $library->Grade_id = $request->Grade_id;
            $library->file_name =  $request->file('file_name')->getClientOriginalName();
            $library->Classroom_id = $request->Classroom_id;
            $library->section_id = $request->section_id;
            $library->teacher_id = 1;
            $library->save();

            $this->uploadFile($request, 'labrary', 'file_name');


            toastr()->success(trans('messages.success'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    //destroy
    public function edit($id)
    {
        $grades = Grade::all();
        $book = library::findorFail($id);
        return view('pages.library.edit', compact('book', 'grades'));
    }

    //destroy
    public function update($request)
    {
        try {

            $book = library::findorFail($request->id);
            $book->title = $request->title;

            if ($request->hasfile('file_name')) {

                $this->deleteFile($book->file_name, 'labrary');

                $this->uploadFile($request, 'labrary', 'file_name');

                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;
            }

            $book->Grade_id = $request->Grade_id;
            $book->classroom_id = $request->Classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;
            $book->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $this->deleteFile($request->file_name, 'labrary');
        library::destroy($request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('library.index');
    }

    public function download($filename)
    {
        return response()->download(public_path('attachments/library/' . $filename));
    }
}
