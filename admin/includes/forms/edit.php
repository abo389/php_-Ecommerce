<?php
$url = $_SERVER["REQUEST_URI"];
$_SESSION["last_url"] = $url;
include("includes/template/inputs.php");
$id = $_GET["id"];
?>
<div class="container">
  <form class="row g-3" action="includes/functions/do_edit.php" method="post" enctype="multipart/form-data">
    <input type="text" hidden name="id" value="<?=$id?>">
    <input type="text" hidden name="table_name" value="<?=$_GET["name"]?>">
    <?php echo inputs($id); ?>
    <?php unset($_SESSION["errors"]); ?>
    <div class="col-12">
      <button class="btn btn-primary" type="submit"> Update </button>
    </div> 
  </form>
</div>

