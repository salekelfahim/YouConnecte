<?php

namespace App\Services;

use App\Models\User;

interface IUserService 
{
    public function registerUser($name, $email, $password);
    public function loginUser($email, $password);
    public function logoutUser();
}