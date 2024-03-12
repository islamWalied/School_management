<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ClassSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['getRecord'] = ClassSubject::getRecord();
        return view('dashboard.assign_subjects.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = Subject::getSubject();
        return view('dashboard.assign_subjects.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!empty($request->subject_id))
        {
            foreach ($request->subject_id as $subject_id)
            {
                $getAlreadyFirst = ClassSubject::getAlreadyFirst($request->class_id, $subject_id);
                if (!empty($getAlreadyFirst))
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }
                else {
                    $assign = ClassSubject::create([
                        'class_model_id' => $request->class_id,
                        'subject_id' => $subject_id,
                        'status' => $request->status,
                        'created_by' => Auth::user()->id
                    ]);
                }

            }
            return redirect()->route('admin.assign.list')->with('success','The Subject is assigned successfully');
        }else{
            return redirect()->back()->with('error','Due to some errors please try again');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassSubject $classSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassSubject $classSubject)
    {
        if (!empty($classSubject))
        {
            $data['getAssignSubjectID'] = ClassSubject::getAssignSubjectID($classSubject->class_model_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = Subject::getSubject();
            return view('dashboard.assign_subjects.edit',$data,compact('classSubject'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassSubject $classSubject)
    {
        ClassSubject::deleteSubject($request->class_id);
        if (!empty($request->subject_id))
        {
            foreach ($request->subject_id as $subject_id)
            {
                $getAlreadyFirst = ClassSubject::getAlreadyFirst($request->class_id, $subject_id);
                if (!empty($getAlreadyFirst))
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }
                else {
                    $assign = ClassSubject::create([
                        'class_model_id' => $request->class_id,
                        'subject_id' => $subject_id,
                        'status' => $request->status,
                        'created_by' => Auth::user()->id
                    ]);
                }

            }
            return redirect()->route('admin.assign.list')->with('success','The Subject is assigned successfully');
        }else{
            return redirect()->back()->with('error','Due to some errors please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassSubject $classSubject)
    {
        $classSubject->delete();
        return redirect()->back()->with('danger','Assigned Deleted!');
    }
    public function edit_status(ClassSubject $classSubject)
    {
        if (!empty($classSubject))
        {
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = Subject::getSubject();
            return view('dashboard.assign_subjects.edit_status',$data,compact('classSubject'));
        }
    }
    public function update_status(Request $request, ClassSubject $classSubject)
    {
        $getAlreadyFirst = ClassSubject::getAlreadyFirst($request->class_id, $request->subject_id);
        if (!empty($getAlreadyFirst))
        {
            $getAlreadyFirst->status = $request->status;
            $getAlreadyFirst->save();
            return redirect()->route('admin.assign.list')->with('success','Status is updated successfully');
        }
        else {
            $assign = ClassSubject::create([
                'class_model_id' => $request->class_id,
                'subject_id' => $request->subject_id,
                'status' => $request->status,
                'created_by' => Auth::user()->id
            ]);
        }

        return redirect()->route('admin.assign.list')->with('success','Updated Successfully');
    }


}
