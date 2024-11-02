<div class="container-fluid">
    <?php
      include("./includes/functions/select_table.php");
      include("./includes/functions/permissions.php");
      $table_name = $_GET["name"];
      $select = select_table($table_name);
      
      
      $colum_names = array_keys($conn->query($select)->fetch_all(MYSQLI_ASSOC)[0]);
      if($table_name === "products" || $table_name === "images") array_push($colum_names,"image");
      $items_nums = count($conn->query($select)->fetch_all());
      $_SESSION["table_data"] = $conn->query($select)->fetch_all(MYSQLI_ASSOC);
      if($table_name === "users") {
        $current_user = current_user_row();
        array_unshift($_SESSION["table_data"], $current_user);
        $items_nums++;
      };

      $_SESSION["colum_names"] = $colum_names;
    ?>
          <!-- Modal -->
        <?php
        foreach($_SESSION["table_data"] as $p) {
        ?>
      <div class="modal fade" id="<?=$table_name."-".$p["id"]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Are You sure</h1>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
              this action can be reversed
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" data-dismiss="modal" id="<?=$table_name."-".$p["id"]?>" class="btn btn-danger do-delete">Delete</button>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
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
                        $item_id = $_SESSION["table_data"][$i]["id"];
                        echo "<tr id='item-$item_id'>";
                        foreach($colum_names as $n) {
                          if($n === "description") {
                            echo "<td style='max-width: 300px;'>".substr($_SESSION["table_data"][$i][$n],0,100)."</td>";
                          }
                          elseif ($n === "image") {
                            if($table_name === "products") {
                              $pro_id = $_SESSION["table_data"][$i]["id"];
                              $select = "SELECT name FROM `images` WHERE pro_id='$pro_id'";
                              $data = $conn->query($select)->fetch_all(MYSQLI_ASSOC);
                              echo "<td>";
                              foreach($data as $img) {
                                echo "<img style='width: 50px;' src='images/$img[name]' />";
                              }
                              echo "</td>";
                            }
                            if($table_name === "images") {
                              $name = $_SESSION["table_data"][$i]["name"];
                              echo "<td><img style='height: 50px;' src='images/$name'/></td>";
                            }
                            
                          }
                          else {
                            echo "<td>".$_SESSION["table_data"][$i][$n]."</td>";
                          }
                        } 
                        echo permissions($_SESSION["table_data"][$i]["id"]);
                        echo "</tr>";
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>