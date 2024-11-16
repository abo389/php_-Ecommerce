<?php

include_once 'connection/Database.php';
include_once 'interFace.php';

class SmallTable implements Controller {
    private $conn;

    public function __construct(private $table) {
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
        $query = "SELECT * FROM ".$this->table." WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC) or
        die(json_encode(["message" => "there no {$this->table} with id => $id"]));
        echo json_encode($data);
    }

    public function create($data) {
        $this->checkBodyFormat($data);
        $query = "INSERT INTO ".$this->table." SET name = :name";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $data["name"]);
        if($stmt->execute()) {
            echo json_encode(["message" => "{$this->table} created successfully"]);
        }  else {
            echo json_encode(["message" => "{$this->table} creation failed"]);
        }
    }

    public function update($id, $data) {
        $this->checkBodyFormat($data);
        $query = "UPDATE ".$this->table." SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $data["name"]);
        $stmt->bindParam(":id", $id);
        if (!empty($id) && $stmt->execute()) {
            echo json_encode(["message" => "{$this->table} updated successfully"]);
        } else {
            echo json_encode(["message" => "{$this->table} update failed"]);
        }
    }

    public function delete($id) {
        $query = "DELETE FROM ".$this->table." WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        if (!empty($id) && $stmt->execute()) {
            echo json_encode(["message" => "{$this->table} deleted successfully"]);
        } else {
            echo json_encode(["message" => "{$this->table} deletion failed"]);
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
            die(json_encode([
            "message" => "body format must be like this" ,
            "body" => [
            'name'=> "[Your {$this->table} name]",
            ]]));
        }
    }
}
?>
