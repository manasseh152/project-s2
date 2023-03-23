<?php

namespace App\Models;
use App\Support\QueryBuilder;

class User extends Model
{
  static array $fillable = ['username', 'password', 'updated_at', 'created_at', 'forget_token', 'forget_token_expire'];

  public static function findUserByUsername($username)
  {
    $user = self::select()->whereRaw('username = :username', ['username' => $username])->get();
    return $user;
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

  public static function createUser($username, $password)
  {
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $user = self::insert([
      'username' => $username,
      'password' => $hashed,
    ]);

    return $user;
  }
  
}
