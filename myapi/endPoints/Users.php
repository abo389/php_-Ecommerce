<?php

include_once 'connection/Database.php';
include_once 'interFace.php';

class User implements Controller {
    private $conn;
    private $table = "users";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Method to get all users
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    // Method to get a single user by ID
    public function getById($id) {
        $query = "SELECT * FROM ".$this->table." WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC) or
        die(json_encode(["message" => "there no item with id => $id"]));
        echo json_encode($data);
    }

    // Method to create a new user
    public function create($data) {
        $this->checkBodyFormat($data);
        $query = "INSERT INTO 
        ".$this->table." (name, password, email, gender, permission)
        VALUES (:name, :password, :email, :gender, :permission)";
        $stmt = $this->conn->prepare($query);
        foreach ($data as $key => $value) {
          $stmt->bindParam(":$key", $value);
        }
        if($stmt->execute()) {
            echo json_encode(["message" => "user created successfully"]);
        }  else {
            echo json_encode(["message" => "user creation failed"]);
        }
    }

    // Method to update an existing user
    public function update($id, $data) {
        $this->checkBodyFormat($data);
        $query = "UPDATE ".$this->table." SET 
        name = :name, 
        password = :password,
        email = :email,
        gender = :gender,
        permission = :permission,
        WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        foreach ($data as $key => $value) {
            $stmt->bindParam(":$key", $value);
        }
        $stmt->bindParam(":id", $id);
        if (!empty($id) && $stmt->execute()) {
            echo json_encode(["message" => "user updated successfully"]);
        } else {
            echo json_encode(["message" => "user update failed"]);
        }
    }

    // Method to delete a user
    public function delete($id) {
        $query = "DELETE FROM ".$this->table." WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        if (!empty($id) && $stmt->execute()) {
            echo json_encode(["message" => "user deleted successfully"]);
        } else {
            echo json_encode(["message" => "user deletion failed"]);
        }
    }

    public function checkBodyFormat($data) {
        if
        (
            empty($data) ||
            count($data) != 5 ||
            !isset($data["name"]) || 
            !isset($data["password"]) ||
            !isset($data["email"]) ||
            !isset($data["gender"]) ||
            !isset($data["permission"]) 
        )
        {
            die(json_encode(["message" => "body format must be like this" , 
            "body" => [
            'name'=> "[Your {$this->table} name]",
            'password'=> "[Your {$this->table} password]",
            'email'=> "[Your {$this->table} email]",
            'gender'=> "[Your {$this->table} gender]",
            'permission'=> "[Your {$this->table} permission]"
            ]]));
        }
    }
}
?>