<?php

namespace App\Models;

use App\Libraries\Database;

class User
{
  private static Database $db;
  private static ?User $instance = null;

  public function __construct()
  {
    self::$db = Database::getInstance();
  }

  public static function getInstance(): User
  {
    if (self::$instance === null) {
      self::$instance = new User();
    }
    return self::$instance;
  }

  public static function getAll(): array
  {
    self::$db->query('SELECT * FROM users');
    return self::$db->resultSet();
  }

  public static function get(int $id): object
  {
    self::$db->query('SELECT * FROM users WHERE id = :id');
    self::$db->bind(':id', $id);
    return self::$db->single();
  }

  public static function insert(string $email, string $password): bool
  {
    self::$db->query('INSERT INTO users (email, password) VALUES (:email, :password)');
    self::$db->bind(':email', $email);
    self::$db->bind(':password', $password);
    return self::$db->execute();
  }

  public static function update(int $id, string $email, string $password): bool
  {
    self::$db->query('UPDATE users SET email = :email, password = :password WHERE id = :id');
    self::$db->bind(':id', $id);
    self::$db->bind(':email', $email);
    self::$db->bind(':password', $password);
    return self::$db->execute();
  }

  public static function delete(int $id): bool
  {
    self::$db->query('DELETE FROM users WHERE id = :id');
    self::$db->bind(':id', $id);
    return self::$db->execute();
  }

  public static function getByEmail(string $email): object
  {
    self::$db->query('SELECT * FROM users WHERE email = :email');
    self::$db->bind(':email', $email);
    return self::$db->single();
  }
}
