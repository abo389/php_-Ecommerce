<?php 

  function error_msg($colum_name) {
    if(isset($_SESSION["errors"][$colum_name])) {
      $msg = "<div class='alert alert-danger'>".$_SESSION['errors'][$colum_name]."</div>";
      return $msg;
    } else {
      return "";
    }
  }

?>