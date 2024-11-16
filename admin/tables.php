<?php 
if(!isset($_GET["name"])) {
  header("Location: 404.php");
  exit();
};

include("./includes/template/header.php");
include("./includes/functions/connect.php");


$action = @$_GET["action"];
if(!isset($_GET["action"])) include("./includes/forms/table.php");
elseif ($action === "edit") include("./includes/forms/edit.php");
// elseif ($action === "add") include("./includes/forms/add.php");
// elseif ($action === "delete") include("./includes/forms/delete.php");



include("./includes/template/footer.php");
?>