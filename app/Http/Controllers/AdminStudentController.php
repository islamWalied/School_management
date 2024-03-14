<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminStudentController extends Controller
{
    public function index()
    {
        $data['getRecord'] = User::getStudent();
        return view('dashboard.admin.student.list',$data);
    }
    public function create()
    {
        $data['getClass'] = ClassModel::getClass();
        return view('dashboard.admin.student.add',$data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:users|email',
            'admission_number' => 'required|numeric',
            'admission_date' => 'required|date',
            'roll_number' => 'required|numeric',
            'class_model_id' => 'required|numeric',
            'gender' => 'required|in:male,female',
            'status' => 'required|in:active,inactive',
            'religion' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'phone_number' => 'nullable|numeric',
            'blood_group' => 'nullable|string',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
        ]);
        $image = null;
        if ($request->hasFile('image'))
        {
            $image = $request->file('image')->store('students','public');
        }
        $student = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'admission_number' => $request->admission_number,
            'admission_date' => $request->admission_date,
            'roll_number' => $request->roll_number,
            'class_model_id' => $request->class_model_id,
            'gender' => $request->gender,
            'status' => $request->status,
            'religion' => $request->religion,
            'date_of_birth' => $request->date_of_birth,
            'phone_number' => $request->phone_number,
            'image' => $image,
            'blood_group' => $request->blood_group,
            'height' => $request->height,
            'weight' => $request->weight,
        ]);
        return redirect()->route('admin.student.list')->with('success','Student Created Successfully!');
    }
}
