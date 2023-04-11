<?php

namespace App\Libraries;

use PDO;
use PDOException;
use PDOStatement;

/**
 * A class that provides an easy way to interact with a MySQL database using PDO.
 */
class Database
{
  private static ?Database $instance = null;

  private PDO $dbHandler;
  private PDOStatement $statement;
  private string $host;
  private string $dbName;
  private string $user;
  private string $password;

  public function __construct()
  {
    $this->host = $_ENV['DB_HOST'];
    $this->dbName = $_ENV['DB_NAME'];
    $this->user = $_ENV['DB_USER'];
    $this->password = $_ENV['DB_PASS'];
    $this->connect();
  }

  /**
   * Returns a singleton instance of the Database class.
   *
   * @return Database
   */
  public static function getInstance(): Database
  {
    if (self::$instance === null) {
      self::$instance = new Database();
    }
    return self::$instance;
  }

  /**
   * Connects to the database using the connection details provided in the constructor.
   */
  private function connect(): void
  {
    $dsn = "mysql:host=$this->host;dbname=$this->dbName;charset=utf8mb4";
    $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
      PDO::ATTR_EMULATE_PREPARES => false,
    ];
    try {
      $this->dbHandler = new PDO($dsn, $this->user, $this->password, $options);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  /**
   * Prepares a SQL query to be executed.
   *
   * @param string $sql The SQL query to prepare.
   */
  public function query(string $sql): void
  {
    $this->statement = $this->dbHandler->prepare($sql);
  }

  /**
   * Binds a value to a parameter in the prepared statement.
   *
   * @param string $parameter The name of the parameter to bind the value to.
   * @param mixed  $value     The value to bind to the parameter.
   * @param int    $type      The data type of the parameter. Defaults to PDO::PARAM_STR if not specified.
   */
  public function bind(string $parameter, mixed $value, ?int $type = null): void
  {
    $type ??= match (true) {
      is_int($value) => PDO::PARAM_INT,
      is_bool($value) => PDO::PARAM_BOOL,
      is_null($value) => PDO::PARAM_NULL,
      default => PDO::PARAM_STR,
    };
    $this->statement->bindValue($parameter, $value, $type);
  }

  /**
   * Executes the prepared statement.
   *
   * @return bool Whether the statement executed successfully or not.
   */
  public function execute(): bool
  {
    return $this->statement->execute();
  }

  /**
   * Returns the result set of the executed query.
   *
   * @return array An array of objects representing the rows returned by the query.
   */
  public function resultSet(): array
  {
    $this->execute();
    return $this->statement->fetchAll();
  }

  /**
   * Returns the first row of the result set of the executed query.
   *
   * @return object|false An object representing the first row returned by the query, or false if there were no results.
   */
  public function single(): object|false
  {
    $this->execute();
    return $this->statement->fetch();
  }

  /**
   * Returns the number of rows affected by the last executed query.
   *
   * @return int The number of rows affected by the last executed query.
   */
  public function rowCount(): int
  {
    return $this->statement->rowCount();
  }
}
