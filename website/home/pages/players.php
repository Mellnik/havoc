	<?php
	if(!isset($_GET['player']))
	{
		msg("Player not registered or invalid.");
	}
	else
	{
		$player = trim($_GET['player']);
		
		if(strlen($player) > 24 || strlen($player) < 3)
		{
			msg("Player not registered or invalid.");
		}
		else
		{
			$stmt = $mysqli->prepare("SELECT `id`, `name`, `admin`, `score`, `money`, `bank`, `kills`, `deaths`, `time`, `reactions`, `gangid`, `gangrank`, `skin`, `winderby`, `winrace`, `wintdm`, `winfallout`, `wingungame`, `vip`, `regdate`, `lastlogin` FROM `accounts` WHERE `name` = ?;");

			$stmt->bind_param("s", $player);
			$stmt->execute();
			$stmt->store_result();
			
			if($stmt->num_rows == 0)
			{
				msg("Player not registered or invalid.");
				
				$stmt->free_result();
				$stmt->close();
			}
			else
			{
				$stmt->bind_result($id, $name, $alevel, $score, $cash, $bank, $kills, $deaths, $time, $reaction, $gangid, $gangrank, $skin, $derby, $race, $tdm, $fallout, $gungame, $vip, $reg, $lastlogged);
			
				$stmt->fetch();
				$stmt->free_result();
				$stmt->close();
				
				$cash = number_format($cash);
				$bank = number_format($bank);
				$time = secondsToTime($time);
				$reg = date("F d, Y", $reg);
				$lastlogged = date("F d, Y", $lastlogged);
				
				if($skin == 0)
				{
					$skin = "/graphics/skins/Skin_0.jpg";
				}
				else
				{
					$skin = "/graphics/skins/Skin_$skin.jpg";
				}
				
				/*$stmt = $mysqli->prepare("SELECT COUNT(`id`) FROM `online` WHERE `name` = ?;");
				$stmt->bind_param("s", $player);
				$stmt->execute();
				$stmt->bind_result($logged);
				$stmt->fetch();
				$stmt->close();*/
				$logged = false;
				if($logged)
				{
					$logged = "<font color='#00ff00'>Online</font>";
				}
				else
				{
					$logged = "<font color='red'>Unknown</font>";
				}
				
				$level = GetRankByLevel($alevel);
			
				echo "<img src='$skin' alt='skin' align='left'/>
						<a href='http://nefserver.net/signature/$player.png'><img src='http://nefserver.net/signature/$player.png' alt='sig' align='right'></a>
							<div style='padding-left: 65px;'>
							<strong>$level $player</strong><br>
							Account ID: #$id<br>
							Joined: $reg<br><br>
							$logged
							</div>
					<br>";

				?>
				<table class="neftable" style="min-width: 100%;">
					<tr>
						<th colspan="3">Main Stats</th>
					</tr>
					<tr>
						<?php

						$stmt = $mysqli->prepare("SELECT `id` FROM `bans` WHERE `id` = ?;");
						$stmt->bind_param("i", $id);
						$stmt->execute();
						$stmt->store_result();
						
						$status = $stmt->num_rows == 0 ? "In good standing" : "<a class='neflink' href='/bans/$player'>Banned</a>";
						$vip = $vip == 0 ? "No" : "Yes";
						
						$stmt->free_result();
						$stmt->close();
						
						$q = $mysqli->query("SELECT COUNT(`id`) FROM `enterprises` WHERE `id` = $id;");
						$r = $q->fetch_row();
						$businesses = $r[0];
						
						$q = $mysqli->query("SELECT COUNT(`id`) FROM `houses` WHERE `id` = $id;");
						$r = $q->fetch_row();
						$houses = $r[0];
						
						echo "<tr><td>Account Status:</td><td width='60%'>$status</td></tr>";
						echo "<tr><td>Very Important Player:</td><td width='60%'>$vip</td></tr>";
						echo "<tr><td>Last seen:</td><td width='60%'>$lastlogged</td></tr>";
						echo "<tr><td>Score:</td><td width='60%'>$score</td></tr>";
						echo "<tr><td>Money:</td><td width='60%'>$$cash</td></tr>";
						echo "<tr><td>Bank:</td><td width='60%'>$$bank</td></tr>";
						echo "<tr><td>Kills:</td><td width='60%'>$kills</td></tr>";
						echo "<tr><td>Deaths:</td><td width='60%'>$deaths</td></tr>";
						echo "<tr><td>K/D:</td><td width='60%'>".round($kills / ($deaths == 0 ? 1 : $deaths), 2)."</td></tr>";
						echo "<tr><td>Time spent playing:</td><td width='60%'>".$time['h']." hours, ".$time['m']." minutes and ".$time['s']." seconds</td></tr>";
						echo "<tr><td>Houses:</td><td width='60%'>$houses</td></tr>";
						echo "<tr><td>Enterprises:</td><td width='60%'>$businesses</td></tr>";
						echo "<tr><td>Reactions won:</td><td width='60%'>$reaction</td></tr>";
						echo "<tr><td>Derbys won:</td><td width='60%'>$derby</td></tr>";
						echo "<tr><td>Races won:</td><td width='60%'>$race</td></tr>";
						echo "<tr><td>TDM wins:</td><td width='60%'>$tdm</td></tr>";
						echo "<tr><td>Fallout wins:</td><td width='60%'>$fallout</td></tr>";
						echo "<tr><td>Gungame wins:</td><td width='60%'>$gungame</td></tr>";
						?>
					</tr>
				</table>
				<?php
				$stmt = $mysqli->prepare("SELECT `oldname`, `newname`, `date` FROM `ncrecords` WHERE `oldname` = ? OR `newname` = ? ORDER BY `date` DESC;");
				$stmt->bind_param("ss", $player, $player);
				$stmt->execute();
				$stmt->store_result();
				
				if($stmt->num_rows > 0)
				{
					?>
					<br>
					<table class="neftable" style="min-width: 100%;">
						<tr>
							<th colspan="3">Name history</th>
						</tr>
						<tr>
					<?php
					$stmt->bind_result($oldname, $newname, $date);
					
					while($stmt->fetch())
					{
						$date = date("d.m.Y H:i:s", $date);
						
						echo "<tr><td><strong>$oldname</strong> changed their name to <strong>$newname</strong> on $date</td></tr>";
					}
					?>
						</tr>
					</table>
					<?php
				}
				
				$stmt->free_result();
				$stmt->close();
			}
		}
	}
	?>