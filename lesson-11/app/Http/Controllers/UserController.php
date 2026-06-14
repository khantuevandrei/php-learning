<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('articles')->paginate(5);
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('users.form', ['isEdit' => false]);
    }

    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());

        return redirect('/users')->with('success', 'User created');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.form', ['user' => $user, 'isEdit' => true]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect('/users')->with('success', 'User updated');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect('/users')->with('success', 'User deleted');
    }
}
