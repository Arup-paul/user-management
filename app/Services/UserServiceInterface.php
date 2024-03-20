<?php

namespace App\Services;

interface UserServiceInterface
{
    public function getAllUsers();
    public function createUser(array $data);
    public function updateUser($user, array $data);
    public function getUserById($userId);
    public function softDeleteUser($userId);
    public function onlyTrashedUsers();

    public function restoreUser($userId);
    public function deleteUserPermanently($userId);
}
