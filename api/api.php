<?php

// api.php
header("Content-Type: application/json");

// Include database configuration
require 'config.php';
require "stmt.php";

// Get the HTTP method, e.g., GET, POST, PUT, DELETE
$method = $_SERVER['REQUEST_METHOD'];

// Capture the request path and parse it
$request = @explode('/', trim($_SERVER['PATH_INFO'],'/'));
if(isset($request)) @[$table_name, $id] = $request;

// Define the API actions
switch ($method) {
    case 'GET':
        if (isset($id)) {
          // Fetch single item by ID
          if($table_name === "products") getSingleItem($pdo, $selectSingelProduct, $id);
          elseif($table_name === "cart") getSingleItem($pdo, $selectCartItem, $id);
          
        } elseif (isset($table_name)) {
            // Fetch all items
            if($table_name === "products") {
              $category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : null;
              $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
              $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 6;
              $offset = ($page - 1) * $limit;
  
              $sql = $selectAllProducts;
  
              $params = []; // :cat_id => num, :limit = num, :offset = num
  
              if ($category_id) {
              $sql .= " WHERE p.cat = :category_id GROUP by p.id ";
              $params[':category_id'] = $category_id;
              }
  
              $sql .= "LIMIT :limit OFFSET :offset";
              $params[':limit'] = $limit;
              $params[':offset'] = $offset;
  
              $stmt1 = $pdo->prepare($sql);
  
              // Bind parameters for pagination and category filter
              foreach ($params as $key => &$val) {
              $stmt1->bindParam($key, $val, PDO::PARAM_INT);
              }
  
              $stmt1->execute();
  
              $items = $stmt1->fetchAll(PDO::FETCH_ASSOC);
              // done step 1

              $stmt1->closeCursor();
  
              // Count total items for pagination
              $totalStmt = $pdo->prepare("SELECT COUNT(*) FROM products" . ($category_id ? " WHERE cat = :category_id" : ""));
              if ($category_id) {
              $totalStmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
              }
              $totalStmt->execute();
              $totalItems = $totalStmt->fetchColumn();
              $totalPages = ceil($totalItems / $limit);
  
              echo json_encode([
              'page' => $page,
              'total_pages' => $totalPages,
              'total_items' => $totalItems,
              'items' => $items
              ]);
            }
            elseif ($table_name === "category") getAllItems($pdo, $selectAllCategory);
        }
        break;

    default:
        echo json_encode(['error' => 'Invalid HTTP Method']);
        break;
}

function getAllItems($pdo, $select) {

    $stmt = $pdo->prepare($select);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

function getSingleItem($pdo, $select, $id) {
    $stmt = $pdo->prepare($select);
    $stmt->execute([$id]);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}
