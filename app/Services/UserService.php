<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserService implements UserServiceInterface
{
    protected $imageUploadService;

    public function __construct(UserImageUploadServiceInterface $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }
    public function getAllUsers()
    {
        return User::where('id', '!=', auth()->id())->latest()->paginate(20);
    }

    public function createUser(array $data)
    {
        if (isset($data['photo'])) {
            $photoPath = $this->imageUploadService->upload($data['photo']);
            $data['photo'] = $photoPath;
        }
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function getUserById($userId)
    {
        return User::with('addresses')->findOrFail($userId);
    }

    public function updateUser($user, array $data)
    {
        if (isset($data['photo'])) {
            $photoPath = $this->imageUploadService->upload($data['photo']);
            $data['photo'] = $photoPath;

            // Delete old photo if exists
            if ($user->photo) {
                Storage::delete('public/photos/'.$user->photo);
            }
        }

        $user->update($data);
        return $user;
    }
    public function softDeleteUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
    }

    public function onlyTrashedUsers()
    {
        return User::onlyTrashed()->latest()->paginate(20);
    }

    public function restoreUser($userId)
    {
        $user = User::withTrashed()->findOrFail($userId);
        $user->restore();
    }

    public function deleteUserPermanently($userId)
    {
        $user = User::withTrashed()->findOrFail($userId);
        if ($user->photo) {
            Storage::delete('public/photos/'.$user->photo);
        }
        $user->forceDelete();
    }



}
