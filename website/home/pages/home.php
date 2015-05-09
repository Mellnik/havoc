		<div align="center">
			<img src="/graphics/havoc.png" alt="Logo"/>
		</div>

		<br>

		<div align="center">

			<font size="5">
			<b>SA-MP Server: <a class="neflink" href="samp://samp.nefserver.net:7777">samp.havocserver.com:7777</a> (46.105.40.127:7777)</b>
			</font>
			<br>
			Server Location: Roubaix, FR (Europe)
			<br><br>
			<font size="6">
			<b><a class="neflink" href="http://files.sa-mp.com/sa-mp-0.3z-R1-install.exe">Download 0.3.7 client to play</a></b>
			<br><br><br>
			</font>
			<div id="smallbox">
			<font size="5"><b>Top gangs of the week</b></font>
			<?php
			$q = $mysqli->query("SELECT `gname`, `gtop` FROM `gangs` ORDER BY `gtop` DESC LIMIT 3;");
			$iter = 0;
			while($row = $q->fetch_row())
			{
				$iter++;
				if($iter == 1) echo("<br><b><font size='4' color='#".dechex(520035939)."'>#1 ".$row[0]." (+".$row[1].")</font></b>");
				if($iter == 2) echo("<br><b><font size='3' color='#F64B4C'>#2 ".$row[0]." (+".$row[1].")</font></b>");
				if($iter == 3) echo("<br><b><font size='3' color='#109ED0'>#3 ".$row[0]." (+".$row[1].")</font></b>");
			} 
			?>
			</div>

		</div>