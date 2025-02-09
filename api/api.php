<?php

// api.php
header("Content-Type: application/json");

// print_r(json_decode(file_get_contents("php://input"), true));

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
              $sort = isset($_GET['sort']) ? strtoupper($_GET['sort']) : null;
              $offset = ($page - 1) * $limit;
  
              $sql = $selectAllProducts;
  
              $params = []; // :cat_id => num, :limit = num, :offset = num
  
              if ($category_id) {
              $sql .= " WHERE p.cat = :category_id ";
              $params[':category_id'] = $category_id;
              }

              $sql .= " GROUP by p.id ";

              if($sort) {
                if($sort === "DESC") $sql .= " ORDER BY p.price DESC ";
                if($sort === "ASC") $sql .= " ORDER BY p.price ASC ";
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

    
  case 'PUT':
      if ($table_name === "cart") {
        $id == "+" ? updateItem($pdo, $updateCartInc) : updateItem($pdo, $updateCartDec);
      } else {
          echo json_encode(['error' => 'No ID specified']);
      }
      break;
  case 'DELETE':
      if ($table_name === "cart") {
          deleteItem($pdo, $deleteCartItem);
      } else {
          echo json_encode(['error' => 'No ID specified']);
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


function updateItem($pdo, $sql) {
  $data = json_decode(file_get_contents("php://input"), true);
  $stmt = $pdo->prepare($sql);
  if ($stmt->execute([$data['user_id'], $data['pro_id']])) {
      echo json_encode(['status' => 'Item updated']);
  } else {
      echo json_encode(['error' => 'Failed to update item']);
  }
}

function deleteItem($pdo, $sql) {
  $data = json_decode(file_get_contents("php://input"), true);
  $stmt = $pdo->prepare($sql);
  if ($stmt->execute([$data["user_id"], $data["pro_id"]])) {
      echo json_encode(['status' => 'Item deleted']);
  } else {
      echo json_encode(['error' => 'Failed to delete item']);
  }
}