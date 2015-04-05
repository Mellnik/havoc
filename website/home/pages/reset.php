	<?php
	if(!isset($_GET['id']))
	{
		?>
		
		<div id="smallbox" style="padding: 5px 15px 5px 15px;">
		<b><font size="4">Password reset</font></b>
		<p>All VIP features are listed on the <a class="neflink" href="http://forum.havocserver.com/showthread.php?19-Very-Important-Player-%28VIP%29-Features">forums</a>.</p>
		<p>
		<div align="center">
		<form class="form" role="form" method="post" action="/vip-proc" accept-charset="UTF-8">
			<b>Account Name:</b> <input type="text" name="account_name" size="30"><br><br>
			<input type="submit" value=" Next -> ">
		</form>
		</div>
		</p>
		<u>Donation reward</u>:
		<ul style="margin-top: 5px; padding-top: 0;">
		  <li>Permanent VIP status including all features</li>
		  <li>VIP badge on forums</li>
		</ul>	
		</div>
	
		<?php
	}
	else
	{
		$id = trim($_GET['id']);
		
		if(strlen($id) > 22 || strlen($id) < 3)
		{
			msg("ID not found or invalid.");
		}
		else
		{
			$stmt = $mysqli->prepare("SELECT `id` FROM `accounts` WHERE `name` = ?;");
			
			$stmt->bind_param("s", $player);
			$stmt->execute();
			$stmt->store_result();
			
			if($stmt->num_rows == 0)
			{
				msg("Player not found or invalid.");
				
				$stmt->free_result();
				$stmt->close();
			}
			else
			{
				$stmt->bind_result($id);
				$stmt->fetch();
				$stmt->free_result();
				$stmt->close();
				
				$q = $mysqli->query("SELECT accounts.name, bans.* FROM bans LEFT JOIN accounts ON accounts.id = bans.admin_id WHERE bans.id = $id;");
				
				if($q->num_rows == 0)
				{
					msg("Player was not banned.");
				}
				else
				{	
					$r = $q->fetch_assoc();
					
					$bans = array();
					$bans['admin'] = $r['name'];
					$bans['reason'] = $r['reason'];
					$bans['lift'] = $r['lift'];
					$bans['date'] = $r['date'];
					?>
					<font face="Oswald" size="20"><?php echo "$player"; ?></font>
					<table class="havoctable" style="min-width: 100%;">
						<tr>
							<th colspan="3">Information</th>
						</tr>
						<tr>
					<?php
					$display = $bans['lift'] == 0 ? "Permanent" : date("d.m.Y H:i:s", $bans['lift']);
					echo "<tr><td>Ban ID:</td><td width='70%'>$id</td></tr>";
					echo "<tr><td>Player profile:</td><td width='70%'><a class='neflink' href='/players/$player'>$player</a></td></tr>";
					echo "<tr><td>Banned by:</td><td width='70%'><a class='neflink' href='/players/".$bans['admin']."'>".$bans['admin']."</a></td></tr>";
					echo "<tr><td>Reason:</td><td width='70%'>".$bans['reason']."</td></tr>";
					echo "<tr><td>Expires:</td><td width='70%'>$display</td></tr>";
					echo "<tr><td>Banned on:</td><td width='70%'>".date("d.m.Y H:i:s", $bans['date'])."</td></tr>";
					echo "<tr><td>Ping:</td><td width='70%'>".$r['ping']."</td></tr>";
					echo "<tr><td>Position:</td><td width='70%'>".$r['xpos']." ".$r['ypos']." ".$r['zpos']."</td></tr>";
					echo "<tr><td>Packetloss:</td><td width='70%'>".$r['packetloss']."%</td></tr>";
					echo "<tr><td>State:</td><td width='70%'>".$r['state']."</td></tr>";
					echo "<tr><td>Health:</td><td width='70%'>".$r['health']."%</td></tr>";
					echo "<tr><td>Armor:</td><td width='70%'>".$r['armor']."%</td></tr>";
					echo "<tr><td>God:</td><td width='70%'>".$r['god']."</td></tr>";
					echo "<tr><td>Weapon:</td><td width='70%'>".$r['weapon']."</td></tr>";
					
					?>
						</tr>
					</table>
					<?php
				}
			}
		}
	}
	?>