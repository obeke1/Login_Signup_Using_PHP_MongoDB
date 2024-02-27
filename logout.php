<?php

session_start();
Unset($_SESSION['email']);

session_destroy();

header('Location: index.php');

?>