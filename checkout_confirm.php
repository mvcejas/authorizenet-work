<?php
//require dirname(__FILE__).'/../config.php';
session_start();
?>
<div class="row-fluid">
	<div style="margin:5px;">
		<h5>Confirm Checkout</h5>
		<hr>
		<?php 
			$currency = 'USD';
			$total_amount = array();
			foreach($_SESSION['cart'] as $item=>$items){
				array_push($total_amount,
					$_SESSION['offers'][$item]['price'] * $items
				);
		?>
		<div class="row-fluid" style="color:#005580;">
			<span class="span7">				
				<?=$_SESSION['offers'][$item]['item'];?>
			</span>
			<span class="span4">
				<a href="javascript:remove_cart('<?=$item;?>');" class="pull-right">&nbsp;&nbsp;<i class="icon-remove"></i></a>
				<span class="pull-right"><?=$items;?> &times; <?=number_format($_SESSION['offers'][$item]['price'],2);?></span>			
			</span>
		</div>
		<?php
			}// each cart
		?>	
		<div class="row-fluid" style="border-top:1px solid #efefef;padding-top:10px;">	
			<span class="span7">				
				<strong>Total Amount</strong>
			</span>	
			<span class="span4">
				<span class="pull-right">&nbsp;&nbsp;<i class="icon-tag"></i></span>
				<span class="pull-right"><strong><?=number_format(array_sum($total_amount),2);?></strong></span>
			</span>
		</div>
		<div class="row-fluid"><p>*Note: SoVI will charge a $2.50 per transaction service fee.</p></div>
		<div class="row-fluid" style="border-top:1px solid #efefef;padding-top:10px;">		
			<p class="pull-left">
				To update your order <a href="javascript:offers();">click here</a>.<br>
				To edit your payment method <a href="javascript:update_billing();">click here</a>.
			</p>
			<?php if(array_sum($total_amount)!=0){?>
				<a href="javascript:checkout_confirm();" onclick="$(this).text('Processing...').addClass('disabled').removeClass('btn-primary');" class="btn btn-primary pull-right">Confirm &amp; Pay</a>
			<?php }else{?>
				<a href="javascript:offers();" class="btn pull-right" style="margin:0 5px 5px 0;">Return</a>
			<?php }?>
		</div>
	</div>
</div>
<?php
	$_SESSION['total_cart'] = array_sum($total_amount);
?>