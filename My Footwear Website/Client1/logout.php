<?php
session_start();

unset($_SESSION['User_id']);
session_destroy();

header("location:index.php");
exit;
?>