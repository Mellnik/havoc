	<div id="smallbox" style="padding: 5px 15px 5px 15px;">
	<b><font size="4">Very Important Player (VIP) - $15 one time donation</font></b>
	<br>
	<?php
	if(isset($_POST['account_name']))
	{	
		$player = trim($_POST['account_name']);
		$stmt = $mysqli->prepare("SELECT `name`, `vip`, `id` FROM `accounts` WHERE `name` = ?;");
		$stmt->bind_param("s", $player);
		$stmt->execute();
		$stmt->store_result();
		
		if($stmt->num_rows == 0)
		{
			echo("<p>The account was not found, start over again (<a class='neflink' href='/vip'>Get NEF VIP</a>).</p>");
			$stmt->free_result();
			$stmt->close();
		}
		else
		{
			$stmt->bind_result($player, $vip, $id);
			$stmt->fetch();
			$stmt->free_result();
			$stmt->close();
			
			?>
			<p>You can donate using PayPal or your phone. After the donation was completed your reward will be set automatically.</p>
			<div align="center">
			You are donating for <a class="neflink" href="/players/<?php echo($player); ?>"><?php echo($player); ?></a> (Account ID: <?php echo($id); ?>).<br><br>
			<div style="display: table;">
			<div style="vertical-align: middle; display: table-cell; padding-right: 10px;">
			<b><font size="2">PayPal / Credit Card</font></b>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="nefnotification@gmail.com">
			<input type="hidden" name="lc" value="US">
			<input type="hidden" name="item_name" value="Havoc VIP (SA-MP)">
			<input type="hidden" name="item_number" value="HAVOC-VIP-FREEROAM">
			<input type="hidden" name="amount" value="15.00">
			<input type="hidden" name="currency_code" value="USD">
			<input type="hidden" name="button_subtype" value="services">
			<input type="hidden" name="no_note" value="1">
			<input type="hidden" name="no_shipping" value="1">
			<input type="hidden" name="rm" value="1">
			<input type="hidden" name="return" value="https://havocserver.com/vip-complete">
			<input type="hidden" name="cancel_return" value="https://havocserver.com/donate">
			<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
			<input type="hidden" name="notify_url" value="https://havocserver.com/gateway/ipn_paypal.php">
			<input type="hidden" name="custom" value="<?php echo($id); ?>">
			<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
			</div>
			
- 			<div style="vertical-align: middle; display: table-cell; padding-left: 10px;">
-			<b><font size="2">Pay by phone (SMS)</font></b><br>
-			
			<a id="fmp-button" href="#" rel="d91bf7c4215dcde69361c826c3532a5c/<?php echo($id); ?>"><img src="//fortumo.com/images/fmp/fortumopay_96x47.png" width="96" height="47" alt="Mobile Payments by Fortumo" border="0" /></a>

-			</div>
-			</div>
-			</div>
			<?php
		}
		?>
		<br>
		<font size="2">
		By using this service, you agree:<br>
		a) That your payment rests as a donation in all cases.<br>
		b) That chargebacks or payment cancellations may result in a suspension of your account or service.<br>
		c) That refunds can only be claimed within 24 hours.<br>
		</font>
		<?php
	}
	else
	{
		echo("<p>The account was not found, start over again (<a class='neflink' href='/vip'>Get NEF VIP</a>).</p>");
	}
	?>
	</div>