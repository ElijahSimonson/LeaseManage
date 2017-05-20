<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['access']);
setcookie("pass", '', strtotime( '-30 days' ), "/", "", "", TRUE);
setcookie("user", '', strtotime( '-30 days' ), "/", "", "", TRUE);

header("Location: login.php");
?>