<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Dasboard extends Controller
{
    public function viewhome()
    {
        return view('admin.home');
    }

    public function viewuser()
    {
        $users = User::all();
        return view('admin.usertable', compact('users'));
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);

        if (!$user) {
            return back()->with('gagal', 'User not found.');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;

        $user->save();

        return redirect()->back()->with('sukses', 'User updated successfully.');
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required',
        ]);
    
        User::factory()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
    
        return redirect()->back()->with('sukses', 'User added successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('viewuser')->with('success', 'User deleted successfully');
    }
}
