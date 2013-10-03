<?php
include 'states.php';
include 'countries.php';

session_start();

if(isset($_SESSION['billing'])){
	$billing = $_SESSION['billing'];	
?>
<div class="row-fluid">
	<form action="/ajax/billing_confirm.php" method="post" id="billing-form" onsubmit="billing_confirm(this.id);return false;" style="margin:5px;margin-bottom:10px;">
		<fieldset>
			<legend>Billing Information</legend>
			<div class="row-fluid">
				<label>Name on Card</label>
				<input type="text" name="first_name" placeholder="First Name" value="<?=$billing['first_name'];?>" class="span6" maxlength="80" required>
				<input type="text" name="last_name" placeholder="Last Name" value="<?=$billing['last_name'];?>" class="span6" maxlength="80" required>
			</div>
			<div class="row-fluid">			
				<span class="span9">
					<label>Card number</label>
					<input type="text" name="card_number" value="<?=$billing['card_number'];?>" placeholder="xxxx-xxxx-xxxx-xxxx" class="span12" maxlength="19" required>
				</span>
				<span class="span3">
					<label>Card Code</label>
					<input type="password" name="card_code" placeholder="xxx" class="span12" maxlength="3" required>
				</span>
			</div>
			<div class="row-fluid">
				<span class="span7">
					<label>Expiration Date</label>
					<select name="exp_date[mm]" class="span6">
					<?php foreach(range(1,12) as $i){
						if($i==$billing['exp_date']['mm']){
					  		printf('<option value="%02d" selected>%02d</option>',$i,$i);
					  	}
					  	else{
					  		printf('<option value="%02d">%02d</option>',$i,$i);
					  	}
					}?>
					</select>
					<select name="exp_date[yy]" class="span6">
					<?php foreach(range(date('Y'),date('Y',strtotime('+5 years'))) as $i){
						if($i==$billing['exp_date']['yy']){
					  		echo '<option value="'.$i.'" selected>'.$i.'</option>';
					  	}
					  	else{
					  		echo '<option value="'.$i.'">'.$i.'</option>';
					  	}
					}?>
					</select>				
				</span>			
			</div>		
			
			<div class="row-fluid">
				<label>Email</label>
				<input type="text" name="email" value="<?=$billing['email'];?>" class="span12" maxlength="120" required>
			</div>
			<div class="row-fluid">
				<label>Address</label>
				<input type="text" name="address" value="<?=$billing['address'];?>" class="span12" maxlength="120" required>
			</div>
			<div class="row-fluid">
				<div class="span8">
				  	<label>City</label>
				  	<input type="text" name="city" value="<?=$billing['city'];?>" class="span12" maxlength="80" required>
				</div>
				<div class="span4">
					<label>State</label>
					<select name="state" class="span12" required>
					<?php
						foreach($states as $key=>$val){
							if($key==$billing['state']){
								echo "<option value=\"$key\" selected>$key - $val</option>";
							}
							else{
								echo "<option value=\"$key\">$key - $val</option>";
							}
						}
					?>						
					</select>
				</div>			
			</div>
			<div class="row-fluid">
				<div class="span4">
				  	<label>Zip Code</label>
				  	<input type="text" name="zip" value="<?=$billing['zip'];?>" class="span12" maxlength="9" required>
				</div>
				<span class="span8">
					<label>Country</label>
					<select name="country" class="span12">
					<?php
						foreach($countries as $key=>$val){
							if($key==$billing['country']){
								echo "<option value=\"$key\" selected>$val</option>";
							}
							else{
								echo "<option value=\"$key\">$val</option>";
							}
						}
					?>				
					</select>
				</span>			
			</div>
			<hr>
			<div class="row-fluid">
				<a href="javascript:offers();" class="btn">Cancel</a> <button type="submit" class="btn btn-primary pull-right">Save &amp; Confirm</button>
			</div>
		</fieldset>
	</form>
</div>

<?php }else{?>
<div class="row-fluid">
	<form action="/ajax/billing_confirm.php" method="post" id="billing-form" onsubmit="billing_confirm(this.id);return false;" style="margin:5px;margin-bottom:10px;">
		<fieldset>
			<legend>Billing Information</legend>
			<div class="row-fluid">
				<label>Name on Card</label>
				<input type="text" name="first_name" placeholder="First Name" class="span6" maxlength="80" required>
				<input type="text" name="last_name" placeholder="Last Name" class="span6" maxlength="80" required>
			</div>
			<div class="row-fluid">			
				<span class="span9">
					<label>Card number</label>
					<input type="text" name="card_number" placeholder="xxxx-xxxx-xxxx-xxxx" class="span12" maxlength="19" required>
				</span>
				<span class="span3">
					<label>Card Code</label>
					<input type="password" name="card_code" placeholder="xxx" class="span12" maxlength="3" required>
				</span>
			</div>
			<div class="row-fluid">
				<span class="span7">
					<label>Expiration Date</label>
					<select name="exp_date['mm']" class="span6">
					<?php foreach(range(1,12) as $i){
						if($i==date('m')){
					  		printf('<option value="%02d" selected>%02d</option>',$i,$i);
					  	}
					  	else{
					  		printf('<option value="%02d">%02d</option>',$i,$i);
					  	}
					}?>
					</select>
					<select name="exp_date['yy']" class="span6">
					<?php foreach(range(date('Y'),date('Y',strtotime('+5 years'))) as $i){
					  echo '<option value="'.$i.'">'.$i.'</option>';
					}?>
					</select>				
				</span>			
			</div>		
			
			<div class="row-fluid">
				<label>Email</label>
				<input type="text" name="email" class="span12" maxlength="120" required>
			</div>
			<div class="row-fluid">
				<label>Address</label>
				<input type="text" name="address" class="span12" maxlength="120" required>
			</div>
			<div class="row-fluid">
				<div class="span8">
				  	<label>City</label>
				  	<input type="text" name="city" class="span12" maxlength="80" required>
				</div>
				<div class="span4">
					<label>State</label>
					<select name="state" class="span12" required>
						<option>CA</option>
					</select>
				</div>			
			</div>
			<div class="row-fluid">
				<div class="span4">
				  	<label>Zip Code</label>
				  	<input type="text" name="zip" class="span12" maxlength="9" required>
				</div>
				<span class="span8">
					<label>Country</label>
					<select name="country" class="span12">
					<?php
						foreach($countries as $key=>$val){
							if($key=='US'){
								echo "<option value=\"$key\" selected>$val</option>";
							}
							else{
								echo "<option value=\"$key\">$val</option>";
							}
						}
					?>				
					</select>
				</span>			
			</div>
			<hr>
			<div class="row-fluid">
				<a href="javascript:offers();" class="btn">Cancel</a> <button type="submit" class="btn btn-primary pull-right">Save &amp; Confirm</button>
			</div>
		</fieldset>
	</form>
</div>
<?php }?>