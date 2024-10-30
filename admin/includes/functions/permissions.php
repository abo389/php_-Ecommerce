<?php
    include("connect.php");
    $table_name = $_GET["name"];
    $permission = $_SESSION["user"]["permission"];
    $current_user_id = $_SESSION["user"]["id"];

  function current_user_row() {
    global $permission,$current_user_id,$conn;
    $select = "SELECT u.id, u.name, u.password, u.email, p.name as permission,g.name as gender
    FROM `users` u,`permission` p,`gender` g 
    WHERE u.permission = p.id 
    AND u.gender = g.id AND permission = '$permission' AND u.id = '$current_user_id'";
    $data = $conn->query($select)->fetch_assoc();
    return $data;
  }

  function permissions($id)  { 
    global $table_name,$permission,$current_user_id;

    $edit_button = <<<HTML
        <a style="display: inline-block;" href="?name=$table_name&action=edit&id=$id">
          <button class="btn btn-secondary">Edit</button>
        </a>
    HTML;
    $delete_button = <<<HTML
    <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#$table_name-$id">
      Delete
    </button>
    HTML;

    if($table_name === "users") {
      if($id === $current_user_id) {
      $controls = $edit_button;
      } else {
        $controls = $edit_button.$delete_button;
      }
    } elseif($table_name === "permission" && $permission > 1) {
      $controls = "";
    } else {
      $controls = $edit_button.$delete_button;
    }

    return $controls;
  }

?>