<?php
class User
{
  private $conn;
  private $table = 'users';

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function emailExists($email)
  {
    $query = "SELECT id FROM {$this->table} WHERE email = :email LIMIT 1";

    // Prepare the statement
    $stmt = $this->conn->prepare($query);

    // Bind parameter
    $stmt->bindParam(':email', $email);

    // Execute the query
    $stmt->execute();

    // Check if a user with the given email exists
    if ($stmt->rowCount() > 0) {
      return true;
    }

    return false;
  }

   public function create(array $data)
    {
        try {
            $query = "
                INSERT INTO {$this->table} 
                (name, username, email, phone_no, summary, password) 
                VALUES (:name, :username, :email, :phone_no, :summary, :password)
            ";

            // Prepare the statement
            $stmt = $this->conn->prepare($query);

            // Sanitize inputs
            $data['name'] = htmlspecialchars(strip_tags($data['name'] ?? ''));
            $data['username'] = htmlspecialchars(strip_tags($data['username'] ?? ''));
            $data['email'] = filter_var($data['email'] ?? '', FILTER_SANITIZE_EMAIL);
            $data['phone_no'] = htmlspecialchars(strip_tags($data['phone_no'] ?? ''));
            $data['summary'] = htmlspecialchars(strip_tags($data['summary'] ?? ''));
            $data['password'] = password_hash($data['password'] ?? '', PASSWORD_BCRYPT);

            // Bind parameters
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':username', $data['username']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':phone_no', $data['phone_no']);
            $stmt->bindParam(':summary', $data['summary']);
            $stmt->bindParam(':password', $data['password']);

            // Execute the query
            if ($stmt->execute()) {
                return true;
            }

            // Log error if the execution fails
            error_log('User creation failed: ' . implode(', ', $stmt->errorInfo()));
            return false;

        } catch (PDOException $e) {
            // Log the exception message
            error_log('Database error: ' . $e->getMessage());
            return false;
        }
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
