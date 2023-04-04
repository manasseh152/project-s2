<?php

namespace App\Models;

use App\Support\QueryBuilder;

class User extends Model
{
  static array $fillable = ['email', 'password', 'updated_at', 'created_at'];

  public static function findUserByEmail($email)
  {
    $user = self::select()->whereRaw('email = :email', ['email' => $email])->get();
    return $user[0];
  }

  public static function findUserByToken($token)
  {
    $user = self::select()->whereRaw('forget_token = :forget_token', ['forget_token' => $token])->get();
    return $user;
  }

  public static function findUserById($id)
  {
    $user = self::select()->whereRaw('id = :id', ['id' => $id])->get();
    return $user;
  }

  public static function createUser($email, $password)
  {
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $user = self::insert([
      'email' => $email,
      'password' => $hashed,
    ]);

    return $user;
  }
}
