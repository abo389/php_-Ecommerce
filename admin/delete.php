<?php
session_start();
include("includes/functions/connect.php");
$id = $_POST["id"];
$table_name = $_POST["name"];

$conn->query("DELETE FROM `$table_name` WHERE id='$id'");

$_SESSION["table_data"] = array_filter($_SESSION["table_data"],
  function ($e) use ($id) {
  return $e["id"] != $id;
});

echo $id;
?>