<?php
session_start();
unset($_SESSION['id']);
session_unset();
session_destroy();
echo "<center>Clearing session please wait...</center>";
header('refresh: .2, url=../index.php');
exit();
