<!DOCTYPE html>

<?php
error_reporting(-1);
ini_set("display_errors", 1);

define("_SITE_", "http://havocserver.com");
define("_FORUM_", "http://forum.havocserver.com");
define("_DONATION_REWARD", 200000); // auch in ipn_paypal.php und ipn_sms.php

include("inc/mysql.inc.php");
include("inc/function.inc.php");
include("inc/mailer.inc.php");
?>

<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta name="keywords" content="havoc, server, sa-mp, samp, sa:mp, stunt, race, dm, deathmatch, freeroam, derby, minigames, gungame, fallout, tdm, team deathmatch, gta, sa, san, andreas, gtasa, multiplayer mod, next generation stunting, awesome, killing floor, gtanet, gtamultiplayer, mtasda, 0.3z, nef, new evolution freeroam, stunt evolution, sev2, sev3, «Stunt/Race/Freeroam/DM»" />
		<meta name="description" content="Anything you have ever wanted from a SA-MP server including Deathmatch/Race/Derby/Gungame and much more." />
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Oswald" />
		<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
		<script src="//fortumo.com/javascripts/fortumopay.js" type="text/javascript"></script>
		<link rel="icon" type="image/ico" href="/graphics/favicon.ico"/>
		<style type="text/css">
		body {
			padding-top: 20px;
			padding-bottom: 40px;
		}
		</style>
		<title>Havoc SA-MP Server</title>
	</head>

	<body>
		<div id="navbar">
			<div id="navbarInner">
				<div id="navbarLinks">
					<a href="<?php echo(_SITE_); ?>">home</a>
					<a href="<?php echo(_FORUM_); ?>">forum</a>
					<a href="/rankings">rankings</a>
					<a href="/donate">donate</a>
					<a href="/about">about</a>
				</div>
				
				<div id="navbarButtons">
				<?php
					$num_players = 0;
					
					$query = $mysqli->query("SELECT `value` FROM `server` WHERE `name` = 'online';");
					$row = $query->fetch_row();
					$num_players += $row[0];
					?>
					<a href="/servers"><?php echo $num_players; ?> players online</a>
				</div>
			</div>
		</div>
		<br>
		<div id="content">
			<?php
			if(!isset($_GET['page'])) 
			{
				$_GET['page'] = 'home';
			}
			
			if(!empty($_GET['page']))
			{
				$pages = "pages";
				$scandir = scandir($pages, 0);
				unset($scandir[0], $scandir[1]);
				$page =	trim($_GET['page']);
				if(in_array($page.".php", $scandir))
				{
					include($pages."/".$page.".php");
				}
				else
				{
					include("pages/home.php");
				}
			}
			?>
			
			<div class="copyright">
				&copy <?php echo date("Y"); ?> Havoc Server
			</div>
		</div>
	</body>
</html>