	<!--<div id="box">-->
		<table class="havoctable" style='min-width: 100%;'>
			<caption>NEF Staff</caption>

			<tr>
			<th>Name</th><th>Admin Level</th><th>Join date</th><th>Last login</th>
			</tr>
			
			<?php
			
				$query = $mysqli->query("SELECT `name`, `admin`, `regdate`, `lastlogin` FROM `accounts` WHERE `admin` > 0 ORDER BY `admin` DESC;");
				
				for(; $row = $query->fetch_assoc();)
				{
					$player = $row['name'];
					$level = $row['admin'];
					$jd = date("d.m.Y H:i:s", $row['regdate']);
					$ll = date("d.m.Y H:i:s", $row['lastlogin']);
					
					$contents = "";
					$contents .= "<tr>";
					$contents .= "<td><a class='neflink' href='/players/$player'>$player</a></td>";
					$contents .= "<td>$level</td>";
					$contents .= "<td>$jd</td>";
					$contents .= "<td>$ll</td>";
					$contents .= "</tr>";
					echo $contents;
				}
				?>
		</table>
	<!--</div>-->