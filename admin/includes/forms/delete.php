<?php
$id = $_GET["id"];
$table_name = $_GET["name"];

$select_img = "SELECT image FROM `$table_name` WHERE id='$id'";

$conn->query("DELETE FROM `$table_name` WHERE id='$id'");
echo '<script type="text/javascript">';
echo "window.location.href = 'tables.php?name=$table_name';";
echo '</script>';

?>