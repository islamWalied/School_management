<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['getRecord'] = User::getAdmin();
        return view('dashboard.admin.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => 'admin',
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('admin.list')->with('success', 'Admin Added!');
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
    public function edit(string $id)
    {
        $user = User::getUser($id);
        return view('dashboard.admin.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => "required|email|unique:users,email,". $user->id,
        ]);
        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'password' => Hash::make($request->password) ?? $user->password,
        ]);
        return redirect()->route('admin.list')->with('success', 'Admin Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.list')->with('danger', 'Admin Trashed!');
    }
    public function trash()
    {
        $users = User::onlyTrashed()->paginate();
        return view("dashboard.admin.trash",compact("users"));
    }
    public function restore(Request $request, $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return Redirect::route('admin.trash')->with('info','Admin Restored!');
    }
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        return Redirect::route('admin.list')->with('danger','Admin Deleted!');

    }
}
