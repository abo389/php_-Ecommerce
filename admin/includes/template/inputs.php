<?php 
    function inputs($id="") {
      include("./includes/functions/connect.php");
      $colum_names = $_SESSION["colum_names"];
      $table_name = $_GET["name"];
      $output = [];
      $table_name_input = <<<HTML
      <span>
        <span></span>
        <input type="text" hidden name="table_name" value="$table_name">
      </span>
      HTML;
      $output[] = $table_name_input;
      if(!empty($id)) {
        $select = "SELECT * FROM `$table_name` WHERE id='$id'";
        $data = $conn->query($select)->fetch_assoc();
      } 
      if(str_ends_with($table_name,"s")) $table_name = substr($table_name,0,(strlen($table_name)-1));
      $type = "text";

      foreach($colum_names as $k => $v) { 
        if ($v === "id" || $v === "views") continue;
        elseif($v === "price" || $v === "count") $type = "number";
        elseif($v === "password") $type = "password";
        elseif($v === "email") $type = "email";
        elseif($v === "image") { 
          $s1 = <<<HTML
              <div class='col-md-6 mb-3'>
                <label class='form-label'>$table_name $v</label>
                <input type="file" class='form-control' name='images[]' accept="image/*" multiple >
              HTML;
          $s2 = "</div>";
          array_push($output,$s1.$s2);
          continue;
        }
        elseif($v === "cat" || $v === "brand" || $v === "permission" || $v === "gender") {
              $s1 = <<<HTML
                <div class='col-md-6 mb-3'>
                <label for='$k' class='form-label'>$table_name $v</label>
                <select name='$v' class='form-control' id='$k'>
                HTML;
                if($v === "cat") $v = "category";
                $s2 = "<option value=''>select $v</option>";
                if($table_name === "user") {
                  $permission = $_SESSION["user"]["permission"];
                  $all = $conn->query("SELECT * FROM `$v` WHERE id >= '$permission'")->fetch_all(MYSQLI_ASSOC);
                } else {
                  $all = $conn->query("SELECT * FROM ".$v)->fetch_all(MYSQLI_ASSOC);
                }
                $s3 = [];
                foreach($all as $va) {
                  if($v === "category") $v = "cat";
                  $me = (isset($data) && $va["id"] === $data[$v] ) ? 'selected' : "";
                  array_push($s3, "<option $me value='$va[id]'>$va[name]</option>") ;
                }
                $s3 = implode("\n\r",$s3);
                $s4 = "</select></div>";
                array_push($output,$s1.$s2.$s3.$s4);
          continue;
        }
        else $type = "text";
        $me = (isset($data)) ? "value='$data[$v]'":"";
        $s1 = <<<HTML
        <div class="col-md-6 mb-3">
          <label for="$k" class="form-label">$table_name $v</label>
          <input id="$k" name="$v" $me type="$type" class="form-control" >
        HTML;
        $s2 = "</div>";
        array_push($output,$s1.$s2);
      } 
      return implode("\n\r",$output);
    }
    
    ?>
