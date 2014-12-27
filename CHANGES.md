Havoc Freeroam SA-MP Server
===========================

1.00 (1st Feb 2015)
-------------------
- More accurate unixtime conversion.
- Stores system has been rewritten. Stores now load and save from database.
- Bans now include serverside information; Can be viewed at https://havocserver.com/bans
- Account IDs rather than playernames are now being used for internal data handlers.
- Players can now have an offical mapper status (/mappers).
- Namechanges are now attached to an account id rather than a name to prevent confusion.
- New toy slot arrangement:
	Needed score:	Toy slots:
				0		1
			  100		2
			  250 		3
			  650		4
			 1000 		5
			 2000 		6
			 5000		7
			10000		8			
- Set the maximum attached player objects to 8.			
- Enterprise/House slots now rise within score:
	Needed score:      House slots:    Enterprises slots:
			 500           1                 1
			2000           2                 2
			5000           3                 3
		   10000           4                 4
		   25000           5                 5
- House system has been fully rewritten.
   * Every house has fix amount of pv slots which can be used to buy custom cars.
   * You no longer need a specifc score to buy a house.
   * /h now shows all of your houses, select to teleports.
   * /upgrade to upgrade your house interior.
   * /password to lock a house and set a password dialog.
   * /sellto <playerid> <price> to sell your house to another player. (Does not alter interior)
   * /sell will reset the interior.
   * /spawn to set the spawn location in your house.
   * Added '/accept house' to accept house offers.
   * Removed house item system.
   * /hlock has been merged into /lock.
   * /hmenu has been removed.
- Enterprise (Business) changes:
   * Businesses have been renamed to Enterprises.
   * Added type: Bitcoin Mining Farm.
   * /e for a list of your enterprises.
   * Enterpries now have a value like houses.
   * /sellto <playerid> <price> to sell your enterprise to another player. (Does not alter level)
   * /sell resets the level.
- Merged old /accept command into '/accept vip'
- Dialog cleanups to avoid unnecessary overhead.
- Removed announce commands for admins.
- Removed bullet hit sound from deathmatches.
- Renamed /toggletp to /tgo.
- Renamed /specoff to /unspec.
- Renamed /gsetrank to /grank.
- Removed /locate. Now redirects to /id.
- /sell /buy can now be used for houses and enterprises.
- Flip key has been set to key 'Y'.
- Removed Gold Credits system.


TODO
----
- Beim connecten ein whitescreen? http://puu.sh/dLaIH/e79bbcea3e.jpg
- Remove makes total registered players 10000
- Add random messages like * Online players: 
- Add /gstats
- Add custom teleports saved in database
- Add commands: http://puu.sh/dJb5c/46aa9b26f6.jpg
- Add toggle commands like /tgo http://puu.sh/dJbax/ab6bc3faf3.jpg
- add altnamed /id -> find
- http://puu.sh/dJb8H/9089f52700.jpg
- Add mute message in GameTexts http://puu.sh/dJbc2/a0e5912058.jpg
- GZones http://puu.sh/dJbe0/70d6368c92.jpg
- Stats: http://puu.sh/dJbfL/513da7751c.jpg
- After register: http://puu.sh/dJbgC/00b62979eb.jpg
- More stats: http://puu.sh/dJbjf/956204b1f2.jpg
- http://puu.sh/dJbjT/2610536230.jpg
- Sone info mit gametext http://puu.sh/dJbkW/46ca58a7c8.jpg
- Fixed money format bug ($-,1000) http://puu.sh/dJboY/95e82ee65a.jpg

- Removed godmode textdraw
- Nach jedem house/auto/gang/entprise/register kauf sollte ein dialog kommen wit cmds die man nun nutzen kann.
- Internal safetly handlers for score and money ranges.
- Improved spawn points to be more safe for players.
- Duel wins and defeats are now being saved within your account.
- Time bans are now being deleted automatically upon expiration.
- Now using salted whirlpool for password hashing.
- Improved playing time counter for more accurate timings.
- New, better UI.
- Player bounties are now being saved in the database.
- All races have been overhauled.
- Races are now being saved in the datatbase.
- Derby has been rewritten, new maps can now be added easily.
- All file operations have been removed, everything is now in the Havoc database.
- Added admin command to reset houses/enterprises which are being owned by banned players.
- CnR has been rewritten:
- Top gangs are now being reset automatically all 7 days.
- You can no longer vote for the same map in derby.
- Added admin command to set the next derby map manually.
- Spawnpoints have been remapped.
- All teleports have been retaken for a better gameplay experience.
- Airport maps have been improved to make it possible to lift off with a plane.
- Gang score has been reduced if you attack a zone with many members.
- Houses now determine how many private cars you may held within your account.
- You can now sell/buy houses/enterprises/pvs on the Havoc forums.
- Got rid of mSelection, now using an improved UI for toys.
- New /settings dialog values which are being saved in the database:
  * /tgo (Allow teleports to you)
  * /tpm (Allow private messages)
  * /fs (Fight style, now in a dialog)
  * /speedo (Vehicle speedometer)
  * Prefered name color
  * Spawn location (House/Hotspot) 
  * Prefered skin
  * Auto Login
  * /blevel (severity of vehicle boost)
  * /jlevel (severity of vehicle jumps)