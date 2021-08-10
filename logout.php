<?php
	session_start();
    setcookie("token","", time() - 3600);
	session_unset();
	session_destroy();
	header("Location: index.php");