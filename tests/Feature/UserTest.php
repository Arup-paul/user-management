<?php

use App\Models\User;
use App\Services\UserServiceInterface;
use Illuminate\Support\Facades\Storage;

test('it can retrieve all users except the authenticated user', function () {
    User::factory()->count(5)->create();
    $authenticatedUser = User::factory()->create();
    $this->actingAs($authenticatedUser);
    $userService =  app(UserServiceInterface::class);
    $retrievedUsers = $userService->getAllUsers();
    expect($retrievedUsers->count())->toBe(5);
    expect($retrievedUsers->first()->id)->not->toBe($authenticatedUser->id);
});

test('it can create a user', function () {
    $userService = app(UserServiceInterface::class);
    $userData = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password',
    ];
    $user = $userService->createUser($userData);

    expect($user)->toBeInstanceOf(User::class)
        ->and($user->name)->toBe($userData['name'])
        ->and($user->email)->toBe($userData['email']);
});

test('it can update a user', function () {
    $user = User::factory()->create();

    $newData = [
        'name' => 'Updated Name',
        'email' => 'updated@example.com',
    ];
    $userService = app(UserServiceInterface::class);
    $updatedUser = $userService->updateUser($user, $newData);
    expect($updatedUser->name)->toBe($newData['name'])
        ->and($updatedUser->email)->toBe($newData['email']);
});

test('it can soft delete a user', function () {
    $user = User::factory()->create();
    $userService = app(UserServiceInterface::class);
    $userService->softDeleteUser($user->id);
    expect(User::find($user->id))->toBeNull()
        ->and(User::withTrashed()->find($user->id))->not->toBeNull();
});

test('it can retrieve only soft-deleted users', function () {
    User::factory()->count(5)->create();
    $softDeletedUsers = User::factory()->count(3)->create();
    $softDeletedUsers->each(function ($user) {
        $user->delete();
    });
    $userService = app(UserServiceInterface::class);
    $retrievedSoftDeletedUsers = $userService->onlyTrashedUsers();
    expect($retrievedSoftDeletedUsers)->toHaveCount(3);
    $retrievedSoftDeletedUsers->each(function ($user) {
        expect($user->deleted_at)->not->toBeNull();
    });
});

test('it can restore a soft-deleted user', function () {
    $softDeletedUser = User::factory()->create();
    $softDeletedUser->delete();
    $userService = app(UserServiceInterface::class);
    $userService->restoreUser($softDeletedUser->id);
    $restoredUser = User::withTrashed()->find($softDeletedUser->id);
    expect($restoredUser)->not->toBeNull()
        ->and($restoredUser->deleted_at)->toBeNull();
});
test('it can permanently delete a user', function () {
    $user = User::factory()->create();
    Storage::fake('public');
    $userService = app(UserServiceInterface::class);
    $userService->deleteUserPermanently($user->id);
    expect(User::withTrashed()->find($user->id))->toBeNull();

});
