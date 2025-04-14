<?php 
	session_start();
	unset($_SESSION['user']);
	session_commit();
	header('Location: ../index.php')
?>