<!DOCTYPE html>

<?php
error_reporting(-1);
ini_set("display_errors", 1);

define("_SITE_", "https://havocserver.com");
define("_FORUM_", "https://forum.havocserver.com");

include("inc/mysql.inc.php");
include("inc/function.inc.php");
?>

<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta name="keywords" content="havoc, server, sa-mp, samp, sa:mp, stunt, race, dm, deathmatch, freeroam, derby, minigames, gungame, fallout, tdm, team deathmatch, gta, sa, san, andreas, gtasa, multiplayer mod, next generation stunting, awesome, killing floor, gtanet, gtamultiplayer, mtasda, 0.3z, nef, new evolution freeroam, stunt evolution, sev2, sev3, «Stunt/Race/Freeroam/DM»" />
		<meta name="description" content="Anything you have ever wanted from a SA-MP server including Deathmatch/Race/Derby/Gungame and much more." />
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Oswald" />
		<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
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
					<a href="/vip">VIP</a>
					<a href="/gc">gold credits</a>
					<a href="/about">about</a>
				</div>
				
				<div id="navbarButtons">
				<?php
					$num_players = 0;
					
					/*$servers = array(
						array(
						'id' => 'kf1',
						'type' => 'killingfloor',
						'host' => '92.222.11.186:7708',
						),
						array(
						'id' => 'kf2',
						'type' => 'killingfloor',
						'host' => '92.222.11.187:7708',
						),
						array(
						'id' => 'kf3',
						'type' => 'killingfloor',
						'host' => '31.204.152.218:7708',
						),
						array(
						'id' => 'kf4',
						'type' => 'killingfloor',
						'host' => '31.204.152.219:7708',
						),
						array(
						'id' => 'kf5',
						'type' => 'killingfloor',
						'host' => '213.163.74.22:7708',
						),
						array(
						'id' => 'kf6',
						'type' => 'killingfloor',
						'host' => '213.163.74.23:7708',
						),
						array(
						'id' => 'kf7',
						'type' => 'killingfloor',
						'host' => '213.163.74.41:7708',
						)
					);
					
					$gq = new GameQ();
					$gq->addServers($servers);
					$gq->setOption('timeout', 1);
					
					try {
						$data = $gq->requestData();
						//$num_players += $data['kf1']['playercount'];
						//$num_players += $data['kf2']['playercount'];
						//$num_players += $data['kf3']['playercount'];
						//$num_players += $data['kf4']['playercount'];
						//$num_players += $data['kf5']['playercount'];
					}

					catch (GameQ_Exception $e) {
						echo 'An error occurred.';
					}*/
					
					$query = $mysqli->query("SELECT COUNT(`id`) FROM `online`;");
					$row = $query->fetch_row();
					$num_players += $row[0];
					?>
					<a href="/servers"><?php echo $num_players; ?> players online</a>
				</div>
			</div>
		</div>
		<br>
		<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FNewEvolutionFreeroam&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
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
				&copy 2014 New Evolution Freeroam
			</div>
		</div>
	</body>
</html>