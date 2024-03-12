<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ClassModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['getRecord'] = ClassModel::getClasses();
        return view('dashboard.class.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.class.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ClassModel::create([
            'name' => $request->class_name,
            'status' => $request->status,
            'created_by' => Auth::user()->id,
        ]);
        return redirect()->route('admin.class.list')->with('success', 'Class Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassModel $classModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassModel $classModel)
    {
        return view('dashboard.class.edit',compact('classModel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassModel $classModel)
    {
        $classModel->update([
            'name' => $request->class_name ?? $classModel->class_name,
            'status' => $request->status ?? $classModel->status,
        ]);
        return redirect()->route('admin.class.list')->with('success', 'Class Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassModel $classModel)
    {
        $classModel->delete();
        return redirect()->route('admin.class.list')->with('danger', 'Class Trashed!');
    }
    public function trash()
    {
        $classes = ClassModel::onlyTrashed()->paginate();
        return view("dashboard.class.trash",compact("classes"));
    }
    public function restore($id)
    {
        $classes = ClassModel::onlyTrashed()->findOrFail($id);
        $classes->restore();
        return Redirect::route('admin.class.trash')->with('info','Class Restored!');
    }
    public function forceDelete($id)
    {
        $classes = ClassModel::onlyTrashed()->findOrFail($id);
        $classes->forceDelete();
        return Redirect::route('admin.class.list')->with('danger','Class Deleted!');

    }
}
