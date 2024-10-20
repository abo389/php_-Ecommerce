<?php
include("../conn.php");

$name = $_POST["name"];
$price = $_POST["price"];
// $img = $_POST["image"];
$cat = $_POST["cat"];
$brand = $_POST["brand"];
$count = $_POST["count"];
$description = $_POST["description"];

$img_name = $_FILES["image"]["name"];
$img_size = $_FILES["image"]["size"];
$img_tmp = $_FILES["image"]["tmp_name"];
$img_type = explode("/",$_FILES["image"]["type"])[0];


if($img_type !== "image") {
    echo "the file type is not image ";
    exit();
}

if($img_size > 3_000_000) {
    echo "file most be less than 3MB";
    exit();
}

$new_img_name = time().rand(0,100).$img_name;


// Prepare the SQL query
$sql = "INSERT INTO products (name, price, image, cat, brand, count, description) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

// Initialize prepared statement
$stmt = $conn->prepare($sql);

// Bind parameters to the statement (s = string, d = double, i = integer)
$stmt->bind_param("sdsssis", $name, $price, $new_img_name, $cat, $brand, $count, $description);

// Execute the query
if ($stmt->execute()) {
    echo "Product added successfully!";
} else {
    echo "Error: " . $stmt->error;
}


move_uploaded_file($img_tmp, "./../images/$new_img_name");
header("location: ../products.php");