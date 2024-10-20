<?php
$url = $_SERVER["REQUEST_URI"];
$_SESSION["last_url"] = $url;
$colum_names = explode(" ",$_GET["colum_names"]);
$table_name = $_GET["name"];
if(str_ends_with($table_name,"s")) $table_name = substr($table_name,0,(strlen($table_name)-1));
?>
<div class="container">
  <form class="row g-3" action="util/do_add.php" method="post" enctype="multipart/form-data">
    <input type="text" hidden name="table_name" value="<?=$_GET["name"]?>">
    <?php 
    $type = "text";
    foreach($colum_names as $k => $v) { 
      if ($v === "id" || $v === "views") continue;
      elseif($v === "price" || $v === "count") $type = "number";
      elseif($v === "password") $type = "password";
      elseif($v === "email") $type = "email";
      elseif($v === "image") {?>
        <div class='col-md-6 mb-3'>
          <label for='<?=$K?>' class='form-label'><?=$table_name." ".$v?></label>
          <input type="file" class='form-control' id='<?=$K?>' name='images[]' accept="image/*" multiple >
        </div>
      <?php 
      continue;
      }
      elseif($v === "cat" || $v === "brand" || $v === "permission" || $v === "gender") {
        echo "
            <div class='col-md-6 mb-3'>
              <label for='e$k' class='form-label'>$table_name $v</label>
              <select name='$v' type='$type' class='form-control' id='$k' required>";
              if($v === "cat") $v = "category";
              $all = $conn->query("SELECT * FROM ".$v)->fetch_all(MYSQLI_ASSOC);
              foreach($all as $v) {
                echo "<option value='$v[id]'>$v[name]</option>";
              }
              echo "
              </select>
            </div>
        ";
        continue;
      }
      else $type = "text";
    ?>
    <div class="col-md-6 mb-3">
      <label for="e<?=$k?>" class="form-label"><?=$table_name." ".$v?></label>
      <input name="<?=$v?>" type="<?=$type?>" class="form-control" id="e<?=$k?>" >
      <?php 
      if(isset($_SESSION["errors"])) {
        $error_msg = @$_SESSION["errors"][$v];
        if(isset($error_msg)) {
          echo "<div class='alert alert-danger'> $error_msg </div>";
        }
      }
      ?>
    </div>
    <?php } 
    unset($_SESSION["errors"]);
    ?>

    <div class="col-12">
      <button class="btn btn-primary" type="submit"> Add <?=$table_name?></button>
    </div> 
  </form>
</div>

