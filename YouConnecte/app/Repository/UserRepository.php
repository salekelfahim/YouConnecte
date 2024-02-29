<?php
namespace App\Repository;

use App\Models\User;

class UserRepository implements IUserRepository
{
    public function create(array $data)
    {
        return User::create($data);
    }
    public function whereEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
}