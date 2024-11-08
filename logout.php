<?php

session_start();
session_unset();
session_destroy();

echo "<script>
localStorage.removeItem('user_data')
location.href = 'login.php';
</script>";

// header("location: login.php");