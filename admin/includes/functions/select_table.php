<?php 

function select_table($table_name) {
  $permission = $_SESSION["user"]["permission"];


  if($table_name === "products") {
    $select = "SELECT p.id, p.name, p.price, c.name as cat, b.name as brand, `count`, `description`, `views`
            FROM `products` p,`category` c,`brand` b 
            WHERE p.cat = c.id AND p.brand = b.id
            ORDER BY p.id;";
  }
  elseif($table_name === "users") {
    $select = "SELECT u.id, u.name, u.password, u.email, p.name as permission,g.name as gender
            FROM `users` u,`permission` p,`gender` g 
            WHERE u.permission = p.id AND u.gender = g.id AND permission > '$permission'
            order by permission";
  }
  elseif ($table_name === "category" || 
          $table_name === "brand" ||
          $table_name === "images" ||
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

  return $select;

}

?>