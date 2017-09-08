<?php
	function get_header(){
		require_once("includes/header.php");
	}
	
	function get_footer(){
		require_once("includes/footer.php");
	}

	class myDb extends SQLite3{
		function __construct(){
			$this->open('kdc.db');
		}
	}

	$db = new myDb();
	// $res_qry = $db-> query($sel);
	// $data = $res_qry-> fetchArray(SQLITE3_ASSOC);
?>


