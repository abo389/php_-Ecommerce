<div class="container-fluid">
    <?php
      $table_name = $_GET["name"];
      if($table_name === "products") {
        $select = "SELECT p.id, p.name, p.price, c.name as cat, b.name as brand, `count`, `description`, `views`, `image`
                FROM `products` p,`category` c,`brand` b 
                WHERE p.cat = c.id AND p.brand = b.id
                ORDER BY p.id;";
      }
      elseif($table_name === "users") {
        $select = "SELECT u.id, u.name, u.password, u.email, p.name as permission,g.name as gender
                FROM `users` u,`permission` p,`gender` g 
                WHERE u.permission = p.id AND u.gender = g.id;";
      }
      elseif ($table_name === "category" || 
              $table_name === "brand" ||
              $table_name === "permission" ||
              $table_name === "gender") 
      {
        $select = "SELECT * FROM ".$table_name;
      }
      else {
        echo '<script type="text/javascript">';
        echo 'window.location.href = "404.php";';
        echo '</script>';
        exit();
      }
      $colum_names = array_keys($conn->query($select)->fetch_all(MYSQLI_ASSOC)[0]);
      $items_nums = count($conn->query($select)->fetch_all());
      $all = $conn->query($select)->fetch_all(MYSQLI_ASSOC);
    ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?=$table_name?></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <a href="?name=<?=$table_name?>&action=add&colum_names=<?=implode(" ",$colum_names);?>">
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
                    <img src="../admin/images/" alt="">
                    <tbody>
                    <?php
                      for ($i=0; $i < $items_nums; $i++) {
                        echo "<tr>";
                        foreach($colum_names as $n) {
                          if($n === "description") {
                            echo "<td style='max-width: 300px;'>".substr($all[$i][$n],0,100)."</td>";
                          }
                          elseif ($n === "image") {
                            $imgs = explode("," ,$all[$i][$n]);
                            $img_num = count($imgs);
                            $m = ($img_num > 1) ? 'and '.($img_num-1).' more' : ''; 
                            echo "<td>
                            <img style='height: 100px;width: 100%;margin: 5px auto;object-fit: contain;'
                            src='../admin/images/".$imgs[0]."' 
                            alt='$n'>
                            <a href='#'>$m</a>
                            </td>";
                          }
                          else {
                            echo "<td>".$all[$i][$n]."</td>";
                          }
                        } ?>
                          <td>
                            <a href="<?="?name=".$table_name."&action=edit"."&id=".$all[$i]["id"]."&colum_names=".implode(' ',$colum_names)?>">
                              <button class="btn btn-secondary">Edit</button>
                            </a>
                            <a href="?action=delete&name=<?=$table_name."&id=".$all[$i]["id"]?>">
                              <button class="btn btn-danger">Delete</button>
                            </a>
                          </td>
                          </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>