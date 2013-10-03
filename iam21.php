<?php
session_start();

if(isset($_POST['confirm'])){
	if($_POST['confirm']==1){
		$_SESSION['confirm'] = true;
	}
	else{
		unset($_SESSION['confirm']);
	}
}
?>