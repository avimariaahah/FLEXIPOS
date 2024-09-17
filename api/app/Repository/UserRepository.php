<?php

namespace App\Repository;

use App\Interface\Repository\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function findMany()
    {
        return User::all();
    }

    public function findOneById(int $id)
    {
        return User::findOrFail($id);
    }

    public function findOneByEmail(string $email)
    {
        return User::where("email", $email)->first();
    }

    public function create(object $payload)
    {
        $user = new User();
        $user->firstname = $payload->firstname;
        $user->lastname = $payload->lastname;
        $user->email = $payload->email;
        $user->password = Hash::make($payload->password);
        $user->save();

        return $user->fresh();
    }

    public function update(object $payload, int $id)
    {
        $user = User::findOrFail($id);
        $user->firstname = $payload->firstname;
        $user->lastname = $payload->lastname;
        $user->email = $payload->email;
        $user->password = Hash::make($payload->password);
        $user->save();

        return $user->fresh();
    }

    public function delete(int $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return true;
    }
}
