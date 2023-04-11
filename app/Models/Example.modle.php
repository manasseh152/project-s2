<?php

namespace App\Models;

use App\Libraries\Database;

/**
 * Class Example
 * This class represents a model for the example table. The methods in this class are used to interact with the database.
 * Usage:
 * $example = new Example();
 * $example->getAll();
 * @package App\Models
 */
class Example
{
  private static Database $db;
  private static ?Example $instance = null;

  public function __construct()
  {
    self::$db = Database::getInstance();
  }

  /**
   * Returns a singleton instance of the Example class.
   * @return Example
   */
  public static function getInstance(): Example
  {
    if (self::$instance === null) {
      self::$instance = new Example();
    }
    return self::$instance;
  }

  /**
   * Gets all the records from the example table.
   * @return array
   */
  public function getAll(): array
  {
    $this->db->query('SELECT * FROM example');
    return $this->db->resultSet();
  }

  /**
   * Gets a single record from the example table.
   * @param int $id The ID of the record to get.
   * @return object
   */
  public function get(int $id): object
  {
    $this->db->query('SELECT * FROM example WHERE id = :id');
    $this->db->bind(':id', $id);
    return $this->db->single();
  }

  /**
   * Inserts a record into the example table.
   * @param string $name The name of the record to insert.
   * @return bool
   */
  public function insert(string $name): bool
  {
    $this->db->query('INSERT INTO example (name) VALUES (:name)');
    $this->db->bind(':name', $name);
    return $this->db->execute();
  }

  /**
   * Updates a record in the example table.
   * @param int    $id   The ID of the record to update.
   * @param string $name The name of the record to update.
   * @return bool
   */
  public function update(int $id, string $name): bool
  {
    $this->db->query('UPDATE example SET name = :name WHERE id = :id');
    $this->db->bind(':id', $id);
    $this->db->bind(':name', $name);
    return $this->db->execute();
  }

  /**
   * Deletes a record from the example table.
   * @param int $id The ID of the record to delete.
   * @return bool
   */
  public function delete(int $id): bool
  {
    $this->db->query('DELETE FROM example WHERE id = :id');
    $this->db->bind(':id', $id);
    return $this->db->execute();
  }
}
