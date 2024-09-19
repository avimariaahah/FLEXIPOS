<?php

namespace App\Repository;

use App\Interface\Repository\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function findMany()
    {
        return User::all();
    }

    public function findOneById(int $id)
    {
        try {
            return User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw $e; // Optionally handle this differently
        }
    }

    public function findOneByEmail(string $email)
    {
        return User::where("email", $email)->first();
    }

    public function create(object $payload)
    {
        try {
            $user = new User();
            $user->firstname = $payload->firstname;
            $user->lastname = $payload->lastname;
            $user->email = $payload->email;
            $user->password = Hash::make($payload->password);
            $user->save();
            return $user->fresh();
        } catch (\Exception $e) {
            throw $e; // Optionally handle this differently
        }
    }

    public function update(object $payload, int $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->firstname = $payload->firstname;
            $user->lastname = $payload->lastname;
            $user->email = $payload->email;
            if (isset($payload->password)) {
                $user->password = Hash::make($payload->password);
            }
            $user->save();
            return $user->fresh();
        } catch (ModelNotFoundException $e) {
            throw $e; // Optionally handle this differently
        }
    }

    public function delete(int $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return true;
        } catch (ModelNotFoundException $e) {
            throw $e; // Optionally handle this differently
        }
    }
}
