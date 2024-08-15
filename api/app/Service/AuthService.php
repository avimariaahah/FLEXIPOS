<?php

namespace App\Service;

use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\Interface\Repository\UserRepositoryInterface;
use App\Interface\Service\AuthenticationServiceInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthenticationServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authenticate(object $payload)
    {
        $user = $this->userRepository->findOneByEmail($payload->email);

        if (!$user) {
            return response()->json([
                "message" => "User not found!"
            ], Response::HTTP_BAD_REQUEST);
        }

        if (!Hash::check($payload->password, $user->password)) {
            return response()->json([
                "message" => "Invalid Credentials!"
            ], Response::HTTP_UNAUTHORIZED);
        }

        $data = (object) [
            'token' => $user->createToken('auth-token')->plainTextToken,
            'user' => new UserResource($user)
        ];

        return new AuthResource($data);
    }

    public function unauthenticate(object $payload)
    {
        $payload->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully Logged out'
        ], Response::HTTP_OK);
    }
}
