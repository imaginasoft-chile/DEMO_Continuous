<?php

class DBConnection
{
	function Connect(){
		try {
		$mycnx =  new PDO('mysql:host=localhost;port=3308;dbname=pv_empmaruri', 'root', 'root');
				$mycnx->exec("set names utf8");
				return ($mycnx);
			} catch (PDOException $e) {
				print "¡Error!: " . $e->getMessage() . "<br/>";
				die();
			}
	}	
	
	function ConnectToMasterBD(){
		try {
			$mycnx =  new PDO('mysql:host=localhost;port=3308;dbname=cyclo_admin', 'root', 'root');
			$mycnx->exec("set names utf8");
			return ($mycnx);
		} catch (PDOException $e) {
			print "¡Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}	
	
}

?>