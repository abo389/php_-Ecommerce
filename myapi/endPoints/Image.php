<?php

include_once 'connection/Database.php';
include_once 'interFace.php';

class Image  {
    private $conn;
    private $table = "images";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    public function getById($id) {
        $query = "SELECT * FROM ".$this->table." WHERE pro_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC) or
        die(json_encode(["message" => "there no product with id => $id"]));
        echo json_encode($data);
    }

    public function create($id, $data) {
        $this->checkBodyFormat($data);
        $query = "INSERT INTO ".$this->table." (pro_id, name) VALUES (:id, :name)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $data["name"]);
        if(!empty($id) && $stmt->execute()) {
            echo json_encode(["message" => "image created successfully"]);
        }  else {
            echo json_encode(["message" => "image creation failed"]);
        }
    }

    public function update($id, $data) {
        $this->checkBodyFormat($data);
        $query = "UPDATE ".$this->table." SET name = :name, WHERE pro_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $data["name"]);
        $stmt->bindParam(":id", $id);
        
        if (!empty($id) && $stmt->execute()) {
            echo json_encode(["message" => "image updated successfully"]);
        } else {
            echo json_encode(["message" => "image update failed"]);
        }
    }

    public function delete($id) {
        $query = "DELETE FROM ".$this->table." WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        if (!empty($id) && $stmt->execute()) {
            echo json_encode(["message" => "image deleted successfully"]);
        } else {
            echo json_encode(["message" => "image deletion failed"]);
        }
    }

    public function checkBodyFormat($data) {
        if
        (
            empty($data) ||
            count($data) != 1 ||
            !isset($data["name"])
        )
        {
            die(json_encode(["message" => "body format must be like this" , 
            "body" => [
            'name'=> "[Your {$this->table} name]"
            ]]));
        }
    }
}
?>