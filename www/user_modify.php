<?php 

	session_start();
	if(isset($_SESSION['username'])){
	ob_start();
	require('config.php');
	$id=$_GET['u'];	
	$sel= "SELECT * FROM users WHERE id='$id'";
	$res_qry = $db-> query($sel);
	$check = $res_qry-> fetchArray(SQLITE3_ASSOC);
	$status= $check['status'];	
	if($status==0){
		$update= "UPDATE users SET status='1' WHERE id='$id'"; 
		if($db-> query($update)){
			echo "Update Your Information, Thanks!";
			header('location: view_user.php');
		 }else{
			 echo "Update not be Saved!";
			}
	}else{
		$update= "UPDATE users SET status='0' WHERE id='$id'"; 
		if($db-> query($update)){
			echo "Update Your Information, Thanks!";
			header('location: user_trash.php');
		 }else{
			 echo "Update not be Saved!";
			}
	}
		
		
		
	

}else{
		header('location: login.php');
	} 



?>