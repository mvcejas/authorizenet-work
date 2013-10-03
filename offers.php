<?php 
	session_start();

	$offers = array(
		array(
			'sku'   => 'guestlist',
			'item'  => 'Guestlist',
			'price' => '0.00',
			'desc'  => ' '
		),
		array(
			'sku'   => 'advanced_entry',
			'item'  => 'Advanced Entry',
			'price' => '0.00',
			'desc'  => ' '
		),
		array(
			'sku'   => 'bottle_service',
			'item'  => 'Bottle Service',
			'price' => '0.00',
			'desc'  => ' '
		),
	);

	foreach($offers as $item){

		$_SESSION['offers'][$item['sku']] = array(
			'item'=>$item['item'],
			'price'=>$item['price']
		);
?>
<div class="row-fluid">
	<h5 style="margin:4px 0 0 5px;"><?=$item['item'];?><span class="pull-right red"><?=$item['price'];?></span></h5>
</div>
<div class="row-fluid list">
	<div class="span10">				
		<p style="padding:0 5px;word-break:hyphenate"><?=$item['desc'];?></p>
	</div>
	<div class="span2">				
		<input style="width:25px;text-align:center;" type="text" name="<?=$item['sku'];?>" value="<?=isset($_SESSION['cart'][$item['sku']]) ? $_SESSION['cart'][$item['sku']] : 0;?>" onkeyup="update_cart(this.name,this.value);" minlength="1" maxlength="3">
	</div>
</div>
<?php 
	}//each $offers
?>
<div class="row-fluid">
	<label class="inline checkbox" style="margin-left:5px;"> <input type="checkbox" name="iam21" id="iam21" onclick="if($(this).is(':checked')){iam21(1)}else{iam21(0)};" <?=isset($_SESSION['confirm']) ? 'checked' : '';?>> I am 21 years or older</label>
	<a href="javascript:checkout();" class="btn btn-primary pull-right" style="margin:5px;">Book Now</a>
</div>