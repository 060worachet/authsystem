<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function userlist()
    {
        $users = User::all();

        return view('frontend.userlist', compact('users'));
    }

    public function addUserForm()
    {
        return view('frontend.adduser');
    }

    public function addUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);
    
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->save();
    
        return redirect('/userlist')->with('success', 'User added successfully.');
    }
    

}
