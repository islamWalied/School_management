<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['getRecord'] = Subject::getSubjects();
        return view('dashboard.subject.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.subject.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Subject::create([
            'name' => $request->name,
            'status' => $request->status,
            'subject_type' => $request->subject_type,
            'created_by' => Auth::user()->id,
        ]);
        return redirect()->route('admin.subject.list')->with('success', 'Subject Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        return view('dashboard.subject.edit',compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $subject->update([
            'name' => $request->name ?? $subject->name,
            'subject_type' => $request->subject_type ?? $subject->subject_type,
            'status' => $request->status ?? $subject->status,
        ]);
        return redirect()->route('admin.subject.list')->with('success', 'Subject Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subject.list')->with('danger', 'Subject Trashed!');
    }
    public function trash()
    {
        $subjects = Subject::onlyTrashed()->paginate(2);
        return view("dashboard.subject.trash",compact("subjects"));
    }
    public function restore($id)
    {
        $subject = Subject::onlyTrashed()->findOrFail($id);
        $subject->restore();
        return Redirect::route('admin.subject.trash')->with('info','Subject Restored!');
    }
    public function forceDelete($id)
    {
        $subject = Subject::onlyTrashed()->findOrFail($id);
        $subject->forceDelete();
        return Redirect::route('admin.subject.list')->with('danger','Subject Deleted!');

    }
}
