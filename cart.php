<?php
//require dirname(__FILE__).'/../config.php';

session_start();

if(isset($_GET['item']) && isset($_GET['count'])){
	$item_name = $_GET['item'];
	$item_count = (int) $_GET['count'];
	
	if(preg_match('/[0-9]{1,3}/',$item_count)){
		$_SESSION['cart'][$item_name] = $item_count;

		if($item_count<=0){
			unset($_SESSION['cart'][$item_name]);
		}
	}
}
?>