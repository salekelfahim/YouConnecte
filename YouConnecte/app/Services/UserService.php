<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repository\IUserRepository;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    
    public function registerUser($name, $email, $password)
    {
        return $this->userRepository->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }

    public function loginUser($email, $password)
    {
        $user = $this->userRepository->whereEmail($email);
        $donnerUser = compact('email', 'password');
        if (auth()->attempt($donnerUser) && $user && $user->status === 'active') {
            session(['user_id' => $user->id, 'user_name' => $user->name]);
            return true;
        }

        return false;
    }

    public function logoutUser()
    {
        auth()->logout();
    }
}



