<?php

include_once 'connection/Database.php';
include_once 'interFace.php';

class Cart  {
    private $conn;
    private $table = "cart";

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
        $query = "SELECT * FROM ".$this->table." WHERE user_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC) or
        die(json_encode(["message" => "there no user with id => $id"]));
        echo json_encode($data);
    }

    public function create($id, $data) {
        $this->checkBodyFormat($data);
        $query = "INSERT INTO ".$this->table." (pro_id, user_id, quantity) VALUES (:pro_id, :id, :quantity)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":pro_id", $data["pro_id"]);
        $stmt->bindParam(":quantity", $data["quantity"]);
        $stmt->bindParam(":id", $id);
        if(!empty($id) && $stmt->execute()) {
            echo json_encode(["message" => "cart created successfully"]);
        }  else {
            echo json_encode(["message" => "cart creation failed"]);
        }
    }

    public function update($id, $data) {
        $this->checkBodyFormat($data);
        $query = "UPDATE ".$this->table." SET quantity = :quantity WHERE user_id = :id AND pro_id = :pro_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":pro_id", $data["pro_id"]);
        $stmt->bindParam(":quantity", $data["quantity"]);
        $stmt->bindParam(":id", $id);
        
        if (!empty($id) && $stmt->execute()) {
            echo json_encode(["message" => "cart updated successfully"]);
        } else {
            echo json_encode(["message" => "cart update failed"]);
        }
    }

    public function delete($id, $data) {
      $this->checkBodyFormat($data);
        $query = "DELETE FROM ".$this->table." WHERE user_id = :id AND pro_id = :pro_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":pro_id", $data["pro_id"]);
        $stmt->bindParam(":id", $id);
        if (!empty($id) && $stmt->execute()) {
            echo json_encode(["message" => "cart deleted successfully"]);
        } else {
            echo json_encode(["message" => "cart deletion failed"]);
        }
    }

    public function checkBodyFormat($data) {
        if
        (
            empty($data) ||
            count($data) != 2 ||
            !isset($data["pro_id"]) ||
            !isset($data["quantity"])
        )
        {
            die(json_encode(["message" => "body format must be like this" , 
            "body" => [
            'pro_id'=> "[Your product id]",
            'quantity'=> "[Your product quantity]"
            ]]));
        }
    }
}
?>