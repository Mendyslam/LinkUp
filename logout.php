<?php
session_start();

unset($_SESSION['linkup_userid']);

header('location: login.php');
?>