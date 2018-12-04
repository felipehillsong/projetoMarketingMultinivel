<?php
session_start();
unset($_SESSION['smmlogin']);
header("Location: login.php");
?>