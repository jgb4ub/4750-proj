<?php
require("projectconnectdb.php");
session_start();
unset($_SESSION["username"]);
header("Location: http://cs.virginia.edu/~les6ye/CS4750/project/login.php");
?>
