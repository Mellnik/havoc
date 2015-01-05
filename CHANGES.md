Havoc Freeroam SA-MP Server
===========================

Build 1 (1st Feb 2015)
----------------------
- Stores system has been rewritten. Stores now load and save from database.
- Bans now include serverside information; Can be viewed at https://havocserver.com/bans
- Account IDs rather than playernames are now being used for internal data handlers.
- Players can now have an offical mapper status (/mappers).
- Namechanges are now attached to an account id rather than a name to prevent confusion.
- More accurate unixtime conversion for timings.
- New toy slot arrangement:
	Slot 1-4 Usable by everyone, Slot 5-6 VIP only.
- Enterprise/House slots now rise within score:
	Needed score:      House slots:    Enterprises slots:
			 500           1                 1
			1000           2                 2
			3000           3                 3
		   10000           4                 4
		   25000           5                 5
- House system has been fully rewritten.
   * Every house has fix amount of pv slots which can be used to buy custom cars.
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
   * Added '/accept enterprise' to to accept an enterprise offer.
- Merged old /accept command into '/accept vip'
- Dialog cleanups to avoid unnecessary overhead.
- Removed bullet hit sound from deathmatches.
- Renamed /toggletp to /tgo.
- Renamed /specoff to /unspec.
- Renamed /gsetrank to /grank.
- Removed /locate. Now redirects to /id.
- /sell /buy can now be used for houses and enterprises.
- Flip key has been set to key 'Y'.
- Removed Gold Credits system.
- Chat layout: "[Gang Tag] PlayerName (id) chat message text".
- New chat shortcuts:
  #text = Admin chat
  *text = VIP chat
  !text = Gang chat
  $text = Enable color codes
  @text = Reply to a private message
- Added color codes for VIPs: <blue> <red> <green> <yellow>
- Removed /scorefall, /cashfall and announce commands.
- Command /ncrecords is now accessible by everyone.
- Removed dynamic ramps.
- You can now sell/buy houses/enterprises/custom cars on the Havoc Forums.
- Removed godmode textdraw
- Houses now determine how many private cars you may held within your account.
- Player bounties are now being saved within your account.

TODO
----
- http://gamerxserver.com/downloads/GamerX-Commands.txt
- gbase http://puu.sh/dMLsJ/308a8ff150.jpg
- Remove paydays?
- Jetpack Deathmatch
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
- GZones http://puu.sh/dJbe0/70d6368c92.jpg http://puu.sh/dMLo3/0a537ea4e3.jpg
- Stats: http://puu.sh/dJbfL/513da7751c.jpg http://puu.sh/dMLlJ/02980c505f.jpg
- After register: http://puu.sh/dJbgC/00b62979eb.jpg
- More stats: http://puu.sh/dJbjf/956204b1f2.jpg
- http://puu.sh/dJbjT/2610536230.jpg
- Sone info mit gametext http://puu.sh/dJbkW/46ca58a7c8.jpg
- Fixed money format bug ($-,1000) http://puu.sh/dJboY/95e82ee65a.jpg
- You are muted http://puu.sh/dMLpa/738142a012.jpg
- http://puu.sh/dMLr2/92537b0237.jpg
- http://puu.sh/dMLs5/657a188d38.jpg

- VIP restrict /count to range
- Nach jedem house/auto/gang/entprise/register kauf sollte ein dialog kommen wit cmds die man nun nutzen kann.
- Internal safetly handlers for score and money ranges.
- Improved spawn points to be more safe for players.
- Duel wins and defeats are now being saved within your account.
- Time bans are now being deleted automatically upon expiration.
- Now using salted whirlpool for password hashing.
- Improved playing time counter for more accurate timings.
- New, better UI.
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
  * Join message (VIP only)
  
VIP Features
------------
- Access to special modded VIP vehicles in /v.
- Access to VIP-Only chat (/p).
- Spawn with 100% armor in freeroam mode.
- $1,000,000 in-game money to your bank account.
- Ability to spawn a jetpack (/jetpack).
- Spawn the Hydra jet at your location (/hydra).
- Additional slot 5 and 6 in /toys.
- Start a countdown for you and players nearby (/cd).
- Change your nickname all 30 days instead of 90 days.
- Ability to specate players (/spec <playerid>)
- The rainbow effects changes the color of your car very fast (/rainbow).
- Labels:
/label - attach the label
/dlabel - detach the label
/elabel - edit the label text and color
- Get listed in /vip and /admins.
- A join message to all players, can be disabled in /settings.
- Access to VIP-Lounge and VIP-Lounge Invite.
- Access to the restricted part of the admin headquarters (/adminhq).
- Access to exclusive VIP Private Vehicles: Hustler, Bandito, Mower, S.W.A.T., Kotknife and Kart.
- Attach a trailer to your truck (/trailer).
- Refill your health and armor for $5,000 (/harefill).
- Expand your forums inbox to 10,000 PMs.
- Chat color codes: <blue> <red> <green> <yellow>

- exclusive pvs nicht mehr spawnbar für normale spieler?
- Mehr Zinsen?