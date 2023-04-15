<?php
session_start();
//Destroy entire session data.
session_destroy();
$_SESSION["username"] = "";
session_reset();
session_abort();

//redirect page to index.php
header('location:login.php');

?>