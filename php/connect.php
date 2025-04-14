<?php 
	try {
		$conn = new PDO('mysql:host=127.0.0.1;dbname=cz32415_sakura','cz32415_sakura','78KdXzg5!');		
	} catch (PDOException $e) {
		echo 'ОШИБКА'.$e->getMessage()."<br />";
	}
?>