<?php
session_start();

//reinitialize session vars
$_SESSION = array();

session_destroy();

header("location: authentication.php");
exit;
?>