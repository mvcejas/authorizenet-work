<?php
//require dirname(__FILE__).'/../config.php';
require dirname(__FILE__).'/../authorizenet/AuthorizeNet.php';
require dirname(__FILE__).'/../authorizenet/config.php';

session_start();

$transaction = new AuthorizeNetAIM;
$transaction->setSandbox(AUTHORIZENET_SANDBOX);
/* billing info */
$transaction->setFields(
   array(
		'amount'      => $_SESSION['total_cart'] + 2.50, 
		'card_num'    => $_SESSION['billing']['card_number'], 
		'exp_date'    => join($_SESSION['billing']['exp_date']),     
		'card_code'   => $_SESSION['billing']['card_code'],
		'first_name'  => $_SESSION['billing']['first_name'],
		'last_name'   => $_SESSION['billing']['last_name'],
		'email'       => $_SESSION['billing']['email'],
		'address'     => $_SESSION['billing']['address'],
		'city'        => $_SESSION['billing']['city'],
		'state'       => $_SESSION['billing']['state'],
		'zip'         => $_SESSION['billing']['zip'],
		'country'     => $_SESSION['billing']['country'],
		'customer_ip' => $_SERVER['REMOTE_ADDR']
   )
);
/* items on cart */
$item_count = 0;
foreach($_SESSION['cart'] as $item=>$items){
	$transaction->addLineItem(
		$item_count += 1,// Item Id
		$_SESSION['offers'][$item]['item'],// Item Name
		' ',// Item Description
		$items,// Item Quantity
		$_SESSION['offers'][$item]['price'], // Item Unit Price
 		'Y' // Item taxable
	);
}
/* transaction fee description */
$transaction->addLineItem(
	'--',// Item Id
	'Txn Fee',// Item Name
	' ',// Item Description
	1,// Item Quantity
	2.50, // Item Unit Price
	'N' // Item taxable
);
/* custom fields */
foreach($_SESSION['cart'] as $item=>$items){
	$transaction->setCustomField(
		$_SESSION['offers'][$item]['item'],// Item Name		
		$items // Number of orders
 	);
}
/* authorization response */
$response = $transaction->authorizeAndCapture();

if($response->approved){
?>
<div class="row-fluid">
	<h5 style="border-bottom:1px solid #eee;margin-left:5px;">Checkout Completed</h5>
	<h4 style="margin-left:5px;">Thank you!</h4>
	<p style="font-size:14px;padding-left:3px;"><?=$response->response_reason_text;?></p>	
</div>
<?php }
	if($response->declined){
?>
<div class="row-fluid">
	<h5 style="border-bottom:1px solid #eee;margin-left:5px;">Checkout Error</h5>
	<h4 style="margin-left:5px;">Credit Card Declined</h4>
	<p style="font-size:14px;padding-left:3px;"><?=$response->response_reason_text;?></p>
	<p style="font-size:14px;padding-left:3px;">To edit your payment method <a href="javascript:update_billing();">click here</a>.</p>
</div>
<?php }
	if($response->error){
?>
<div class="row-fluid">
	<h5 style="border-bottom:1px solid #eee;margin-left:5px;">Checkout Error</h5>
	<h4 style="margin-left:5px;">Card Authentication Error</h4>
	<p style="font-size:14px;padding-left:3px;"><?=$response->response_reason_text;?></p>	
	<p style="font-size:14px;padding-left:3px;">To edit your payment method <a href="javascript:update_billing();">click here</a>.</p>
</div>
<?php }?>