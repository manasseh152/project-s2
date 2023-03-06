<?php

namespace App\Models;

class User extends Model
{
  protected $fillable = ['username', 'password', 'updated_at', 'created_at'];

  public static function findUserByUsername($username)
  {
    $user = self::select()->whereRaw('username = :username', ['username' => $username])->get();
    return $user;
  }

  public static function findUserById($id)
  {
    $user = self::select()->whereRaw('id = :id', ['id' => $id])->get();
    return $user;
  }

  public static function createUser($username, $password)
  {
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $user = self::create([
      'username' => $username,
      'password' => $hashed,
    ]);

    return $user;
  }
}
