<?php
session_start();
session_destroy();
header("Location: home_before_login.php");
exit();
?>
