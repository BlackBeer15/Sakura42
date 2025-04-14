<?php 
	try {
		$conn = new PDO('mysql:host=#;dbname=#','#','#');		
	} catch (PDOException $e) {
		echo 'ОШИБКА'.$e->getMessage()."<br />";
	}
?>