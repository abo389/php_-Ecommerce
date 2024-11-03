<?php
include("includes/functions/connect.php");
$id = $_POST["id"];
$table_name = $_POST["name"];

$conn->query("DELETE FROM `$table_name` WHERE id='$id'");

echo "done";

?>