<?php
$colum_names = explode(" ",$_GET["colum_names"]);
$table_name = $_GET["name"];
$id = $_GET["id"];
$data = $conn->query("SELECT * FROM `$table_name` WHERE id='$id'")->fetch_assoc();
if(str_ends_with($table_name,"s")) $table_name = substr($table_name,0,(strlen($table_name)-1));
?>
<div class="container">
  <form class="row g-3" action="util/do_edit.php" method="post" enctype="multipart/form-data">
    <input type="text" hidden name="id" value="<?=$id?>">
    <input type="text" hidden name="table_name" value="<?=$_GET["name"]?>">
    <?php 
    $type = "text";
    foreach($colum_names as $k => $v) { 
      if ($v === "id" || $v === "views") continue;
      elseif($v === "price" || $v === "count") $type = "number";
      elseif($v === "image") $type = "file";
      elseif($v === "email") $type = "email";
      elseif($v === "cat" || $v === "brand" || $v === "permission" || $v === "gender") {
        echo "
            <div class='col-md-6 mb-3'>
              <label for='e$k' class='form-label'>$table_name $v</label>
              <select name='$v' type='$type' class='form-control' id='$k' required>";
              if($v === "cat") $v = "category";
              $all = $conn->query("SELECT * FROM ".$v)->fetch_all(MYSQLI_ASSOC);
              foreach($all as $va) {
                $m = ($va["id"] === $data[$v]) ? 'selected' : "";
                echo "<option $m value='$va[id]'>$va[name]</option>";
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
      <input name="<?=$v?>" value="<?=$data[$v]?>" type="<?=$type?>" class="form-control" id="e<?=$k?>" required>
    </div>
    <?php } ?>

    <div class="col-12">
      <button class="btn btn-primary" type="submit"> Update <?=$table_name?></button>
    </div> 
  </form>
</div>

