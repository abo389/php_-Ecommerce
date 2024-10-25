<div class="container-fluid">
    <?php
      include("./includes/functions/select_table.php");
      include("./includes/functions/permissions.php");
      $table_name = $_GET["name"];
      $select = select_table($table_name);

      
      
      $colum_names = array_keys($conn->query($select)->fetch_all(MYSQLI_ASSOC)[0]);
      if($table_name === "products" || $table_name === "images") array_push($colum_names,"image");
      $items_nums = count($conn->query($select)->fetch_all());
      $all = $conn->query($select)->fetch_all(MYSQLI_ASSOC);
      if($table_name === "users") {
        $current_user = current_user_row();
        array_unshift($all, $current_user);
        $items_nums++;
      };

      // echo "<pre>";
      // print_r($all);
      // echo "</pre>";

      $_SESSION["colum_names"] = $colum_names;
    ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?=$table_name?></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <a href="?name=<?=$table_name?>&action=add">
            <button class="my-2 btn btn-success">Add <?=$table_name?></button>
          </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                          <?php
                          foreach($colum_names as $v) { ?>
                            <th><?=$v?></th>
                          <?php } ?>
                          <th style="min-width: 160px;">controls</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      for ($i=0; $i < $items_nums; $i++) {
                        echo "<tr>";
                        foreach($colum_names as $n) {
                          if($n === "description") {
                            echo "<td style='max-width: 300px;'>".substr($all[$i][$n],0,100)."</td>";
                          }
                          elseif ($n === "image") {
                            if($table_name === "products") {
                              $pro_id = $all[$i]["id"];
                              $select = "SELECT name FROM `images` WHERE pro_id='$pro_id'";
                              $data = $conn->query($select)->fetch_all(MYSQLI_ASSOC);
                              echo "<td>";
                              foreach($data as $img) {
                                echo "<img style='width: 50px;' src='images/$img[name]' />";
                              }
                              echo "</td>";
                            }
                            if($table_name === "images") {
                              $name = $all[$i]["name"];
                              echo "<td><img style='height: 50px;' src='images/$name'/></td>";
                            }
                            
                          }
                          else {
                            echo "<td>".$all[$i][$n]."</td>";
                          }
                        } 
                        echo "<td>";
                        echo permissions($all[$i]["id"]);
                        echo "</td>";
                        ?>

                          </tr>
                      <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>