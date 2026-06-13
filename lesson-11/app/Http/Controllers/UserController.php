<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('articles')->get();
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('users.form', ['isEdit' => false]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users,email',
            'age' => 'required|integer|min:1|max:120'
        ]);

        User::create($validate);

        return redirect('/users')->with('success', 'User created');
    }

    public function edit(User $user)
    {
        return view('users.form', ['user' => $user, 'isEdit' => true]);
    }

    public function update(Request $request, User $user)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|min:6',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'age' => 'required|integer|min:1|max:120'
        ]);

        if (empty($validate['password'])) {
            unset($validate['password']);
        }

        $user->update($validate);

        return redirect('/users')->with('success', 'User updated');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/users')->with('success', 'User deleted');
    }
}
