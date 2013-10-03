<?php
//require dirname(__FILE__)."/../config.php";

session_start();

if(isset($_POST) && count($_POST)>0){

	foreach($_POST as $key=>$val){
		$_SESSION['billing'][$key] = $val;
	}
	
	/*
	$first_name   = $_POST['first_name'];
	$last_name    = $_POST['last_name'];
	$card_type    = $_POST['card_type'];
	$card_number  = $_POST['card_number'];
	$card_code    = $_POST['card_code'];
	$card_expires = join($_POST['exp_date']);
	$address      = $_POST['address'];
	$city         = $_POST['city'];
	$state        = $_POST['state'];
	$zip          = $_POST['zip'];
	$country_id   = $_POST['country'];

	$payment_option_id = 1;// credit card
	*/

	$result = array(
		'ok' => false,
		'next_uri' => 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/checkout_confirm.php'
	);

	header("content-type: application/json");
	echo json_encode($result);
}
?>