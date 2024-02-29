<?php
namespace App\Repository;

use App\Models\User;

interface IUserRepository 
{
    public function create(array $data);
    public function whereEmail(string $email);
}