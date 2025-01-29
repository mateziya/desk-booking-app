<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function users()
    {
        $users = User::paginate(10);
        return Inertia::render('UserList', [
            'users' => $users
        ]);
    }
    public function create()
    {
        return Inertia::render('AddUser');
    }
    public function store(Request $request, User $user)
    {
        $credentials = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|lowercase|email|max:255|unique:users,email',
            'role' => 'string',
            'password' => 'required|min:6|confirmed'
        ]);
        $credentials['role'] = strtolower($credentials['role']);
        $user = User::create($credentials);

        return redirect()->route('admin.users');
    }
    public function edit(User $user)
    {
        return Inertia::render('EditUser', [
            'user' => $user
        ]);
    }
    public function update(Request $request, User $user)
    {
        $credentials = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|lowercase|email|max:255|unique:users,email',
            'role' => 'string'
        ]);
        $user->update($credentials);

        return redirect()->route('admin.users');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users');
    }
}