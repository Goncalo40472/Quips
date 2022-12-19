<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', ['users' => $users]);
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users');
    }

    public function profile(User $user)
    {
        return view('profile', ['user' => $user]);
    }
    
}
