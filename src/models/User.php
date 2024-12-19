<?php
class User
{
  private $conn;
  private $table = 'users';

  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Create a new user
  public function create($name, $username, $email, $phone_no, $summary, $password) {
    $query = "INSERT INTO {$this->table} (name, username, email, phone_no, summary, password) 
              VALUES (:name, :username, :email, :phone_no, :summary, :password)";
    $stmt = $this->conn->prepare($query);

    // Sanitize inputs
    $name = htmlspecialchars(strip_tags($name));
    $username = htmlspecialchars(strip_tags($username));
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);  // Use email sanitizer
    $phone_no = htmlspecialchars(strip_tags($phone_no));
    $summary = htmlspecialchars(strip_tags($summary));
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);  // Hash the password once

    // Bind parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone_no', $phone_no);
    $stmt->bindParam(':summary', $summary);
    $stmt->bindParam(':password', $hashedPassword);

    // Execute query
    return $stmt->execute();
}

  // Get all users
  public function read()
  {
    $query = "SELECT * FROM " . $this->table;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
  }

  // Get a single user by ID
  public function readSingle($id)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt;
  }

  // Update a user's information
  public function update($id, $name, $email, $password)
  {
    $query = "UPDATE " . $this->table . " SET name = :name, email = :email, password = :password WHERE id = :id";

    $stmt = $this->conn->prepare($query);

    // Clean data
    $name = htmlspecialchars(strip_tags($name));
    $email = htmlspecialchars(strip_tags($email));
    $password = htmlspecialchars(strip_tags($password));

    // Bind parameters
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT));  // Hash the password

    // Execute query
    if ($stmt->execute()) {
      return true;
    }

    return false;
  }

  // Delete a user
  public function delete($id)
  {
    $query = "DELETE FROM " . $this->table . " WHERE id = :id";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
      return true;
    }

    return false;
  }
}
