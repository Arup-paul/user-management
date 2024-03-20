<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserServiceInterface;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(CreateUserRequest $request)
    {
        $validatedData = $request->validated();
        $this->userService->createUser($validatedData);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedData = $request->validated();

        $this->userService->updateUser($user, $validatedData);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function show($userId)
    {
        $user =  $this->userService->getUserById($userId);
        return view('users.show', compact('user'));
    }

    public function destroy($userId)
    {
        $this->userService->softDeleteUser($userId);
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function trashed()
    {
        $trashedUsers = $this->userService->onlyTrashedUsers();
        return view('users.trashed', compact('trashedUsers'));
    }

    public function restore($id)
    {
        $this->userService->restoreUser($id);
        return redirect()->route('users.trashed')->with('success', 'User restored successfully.');
    }

    public function forceDelete($id)
    {
        $this->userService->deleteUserPermanently($id);
        return redirect()->route('users.trashed')->with('success', 'User permanently deleted successfully.');
    }
}
