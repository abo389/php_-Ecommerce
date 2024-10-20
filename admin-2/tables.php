<?php 
if(!isset($_GET["name"])) {
  header("Location: 404.php");
  exit();
};

include("./includs/header.php"); 
include("../functions/connect.php");

$action = @$_GET["action"];
if(!isset($_GET["action"])) include("./forms/table.php");
elseif ($action === "add") include("./forms/add.php");
elseif ($action === "edit") include("./forms/edit.php");
elseif ($action === "delete") include("./forms/delete.php");
?>

<?php include("./includs/footer.php"); ?>