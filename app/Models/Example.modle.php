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
class Example extends Database
{
  /**
   * Gets all the records from the example table.
   * @return array
   */
  public function getAll(): array
  {
    $this->query('SELECT * FROM example');
    return $this->resultSet();
  }

  /**
   * Gets a single record from the example table.
   * @param int $id The ID of the record to get.
   * @return object
   */
  public function get(int $id): object
  {
    $this->query('SELECT * FROM example WHERE id = :id');
    $this->bind(':id', $id);
    return $this->single();
  }

  /**
   * Inserts a record into the example table.
   * @param string $name The name of the record to insert.
   * @return bool
   */
  public function insert(string $name): bool
  {
    $this->query('INSERT INTO example (name) VALUES (:name)');
    $this->bind(':name', $name);
    return $this->execute();
  }

  /**
   * Updates a record in the example table.
   * @param int    $id   The ID of the record to update.
   * @param string $name The name of the record to update.
   * @return bool
   */
  public function update(int $id, string $name): bool
  {
    $this->query('UPDATE example SET name = :name WHERE id = :id');
    $this->bind(':id', $id);
    $this->bind(':name', $name);
    return $this->execute();
  }

  /**
   * Deletes a record from the example table.
   * @param int $id The ID of the record to delete.
   * @return bool
   */
  public function delete(int $id): bool
  {
    $this->query('DELETE FROM example WHERE id = :id');
    $this->bind(':id', $id);
    return $this->execute();
  }
}
