<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['getRecord'] = User::getParents();
        return view('dashboard.admin.parents.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.parents.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'last_name' => 'nullable|string',
            'email' => 'required|unique:users|email',
            'gender' => 'required|in:male,female',
            'status' => 'required|in:active,inactive',
            'occupation' => 'nullable|string',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|numeric',
        ]);
        $image = null;
        if ($request->hasFile('image'))
        {
            $image = $request->file('image')->store('parents','public');
        }
        $student = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'gender' => $request->gender,
            'occupation' => $request->occupation,
            'address' => $request->address,
            'status' => $request->status,
            'phone_number' => $request->phone_number,
            'image' => $image,
            'user_type' => 'parents',
        ]);
        return redirect()->route('admin.parents.list')->with('success','Parent Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data['getRecord'] = $user;
        return view('dashboard.admin.parents.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'last_name' => 'nullable|string',
            'email' => 'required|email|unique:users,email,'. $user->id,
            'gender' => 'required|in:male,female',
            'occupation' => 'nullable|string',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'phone_number' => 'nullable|numeric',
        ]);
        $image = $user->image;
        if ($image){
            Storage::delete($user->image);
        }
        if ($request->hasFile('image'))
        {
            $image = $request->file('image')->store('parents','public');
        }
        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'occupation' => $request->occupation,
            'address' => $request->address,
            'gender' => $request->gender,
            'status' => $request->status,
            'phone_number' => $request->phone_number,
            'image' => $image,
        ]);
        return redirect()->route('admin.parents.list')->with('success','Parent Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->image)
        {
            Storage::delete($user->image);
        }
        $user->delete();
        return redirect()->back()->with('danger','Parent Deleted Successfully!');
    }
}
