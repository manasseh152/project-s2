<?php

namespace App\Models;

use App\Libraries\Database;
use PDO;

class User extends Model
{
    protected array $fillable = ['email', 'password'];
    public function getUsers()
    {
        return $this->select()->get();
    }
    public function getUserByEmail($email)
    {
        return $this->select()->whereRaw('email = :email', ['email', $email])->get();
    }
    public function creatUser($user)
    {
        $password = password_hash($user['password'], PASSWORD_DEFAULT);
        $this->create([
            'email' => $user['email'],
            'password' => $password
        ]);
    }
}
