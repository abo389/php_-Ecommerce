<?php

include_once 'connection/Database.php';
include_once 'interFace.php';

class Product implements Controller {
    private $conn;
    private $table = "products";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Method to get all products
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    // Method to get a single product by ID
    public function getById($id) {
        $query = "SELECT * FROM ".$this->table." WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC) or
        die(json_encode(["message" => "there no item with id => $id"]));
        echo json_encode($data);
    }

    // Method to create a new product
    public function create($data) {
        $this->checkBodyFormat($data);
        $query = "INSERT INTO ".$this->table." SET 
        name = :name, 
        price = :price, 
        cat = :category_id, 
        brand = :brand_id, 
        count = :count, 
        description = :description";
        $stmt = $this->conn->prepare($query);
        foreach ($data as $key => $value) {
            $stmt->bindParam(":$key", $value);
        }
        if($stmt->execute()) {
            echo json_encode(["message" => "Product created successfully"]);
        }  else {
            echo json_encode(["message" => "Product creation failed"]);
        }
    }

    // Method to update an existing product
    public function update($id, $data) {
        $this->checkBodyFormat($data);
        $query = "UPDATE ".$this->table." SET 
        name = :name, 
        price = :price,
        cat = :category_id, 
        brand = :brand_id, 
        count = :count, 
        description = :description
        WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        foreach ($data as $key => $value) {
            $stmt->bindParam(":$key", $value);
        }
        $stmt->bindParam(":id", $id);
        if (!empty($id) && $stmt->execute()) {
            echo json_encode(["message" => "Product updated successfully"]);
        } else {
            echo json_encode(["message" => "Product update failed"]);
        }
    }

    // Method to delete a product
    public function delete($id) {
        $query = "DELETE FROM ".$this->table." WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        if (!empty($id) && $stmt->execute()) {
            echo json_encode(["message" => "Product deleted successfully"]);
        } else {
            echo json_encode(["message" => "Product deletion failed"]);
        }
    }

    public function checkBodyFormat($data) {
        if
        (
            empty($data) ||
            count($data) != 6 ||
            !isset($data["name"]) || 
            !isset($data["price"]) ||
            !isset($data["category_id"]) ||
            !isset($data["brand_id"]) ||
            !isset($data["count"]) ||
            !isset($data["description"]) 
        )
        {
            die(json_encode(["message" => "body format must be like this" , 
            "body" => [
            'name'=> "[Your {$this->table} name]",
            'price'=> "[Your {$this->table} price]",
            'category_id'=> "[Your {$this->table} category_id]",
            'brand_id'=> "[Your {$this->table} brand_id]",
            'count'=> "[Your {$this->table} count]",
            'description'=> "[Your {$this->table} description]"
            ]]));
        }
    }
}
?>