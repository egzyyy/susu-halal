<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Show create user form.
     */
    public function create($role)
    {
        $validRoles = ['parent', 'shariah', 'nurse', 'clinician', 'lab-tech', 'admin'];

        if (!in_array($role, $validRoles)) {
            abort(404, 'Invalid role');
        }

        return view('hmmc.create-user', compact('role'));
    }

    /**
     * Store new user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'username' => 'required|string|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required|string',
        ]);

        $user = new User([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role'     => $request->input('role'),
        ]);

        $user->save();

        return redirect()->route('hmmc.manage-users')->with('success', 'User created successfully!');
    }
}
