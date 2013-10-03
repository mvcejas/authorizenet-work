<?php
//require dirname(__FILE__).'/../config.php';

session_start();

if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){
	
	if(isset($_SESSION['billing'])){
		$result = array(
			'ok' => true,
			'message' => 'No billing records found.',
			'next_uri' => 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/checkout_confirm.php'
		);
	}
	else{	
		$result = array(
			'ok' => true,
			'message' => 'No billing records found.',
			'next_uri' => 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/billing.php'
		);
	}

	if(!isset($_SESSION['confirm'])){
		$result = array(
			'ok' => false,
			'message' => 'You must confirm that you are 21-year old and above.',			
		);
	}
}
else{
	$result = array(
		'ok' => false,
		'message' => "You have no item on your cart. Please update your cart."
	);
}

header("content-type: application/json");
echo json_encode($result);
?>