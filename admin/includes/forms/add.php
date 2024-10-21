<?php
$url = $_SERVER["REQUEST_URI"];
$_SESSION["last_url"] = $url;
include("includes/template/inputs.php")
?>
<div class="container">
  <form class="row g-3" action="includes/functions/do_add.php" method="post" enctype="multipart/form-data">
    <input type="text" hidden name="table_name" value="<?=$_GET["name"]?>">
    <?php echo inputs(); ?>
    <?php unset($_SESSION["errors"]); ?>
    <div class="col-12">
      <button class="btn btn-primary" type="submit"> Add </button>
    </div> 
  </form>
</div>

