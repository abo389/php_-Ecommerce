<?php

$id = $_GET["id"];
$table_name = $_GET["name"];

$select_img = "SELECT image FROM `$table_name` WHERE id='$id'";
$names = explode(", ",$conn->query($select_img)->fetch_column());

foreach($names as $name) {
    unlink("../admin/images/$name");
}



$conn->query("DELETE FROM `$table_name` WHERE id='$id'");
// header("location: ../tables.php?name=$table_name");
echo '<script type="text/javascript">';
echo "window.location.href = 'tables.php?name=$table_name';";
echo '</script>';

?>