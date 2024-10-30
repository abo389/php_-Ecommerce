<?php
session_start();
include("includes/functions/connect.php");
$id = $_POST["id"];
$table_name = $_POST["name"];

$conn->query("DELETE FROM `$table_name` WHERE id='$id'");

$_SESSION["table_data"] = array_filter($_SESSION["table_data"], function ($e) use ($id) {
  return $e["id"] != $id;
});
// foreach($_SESSION["table_data"] as $d) {
//   if($d == $id)
// }
print_r($_SESSION["table_data"]);
echo "the ".$table_name." has been deleted succsessfule";
?>