Havoc Freeroam SA-MP Server
===========================

Build 1 (1st Feb 2015)
----------------------
- Stores (24/7, Banks, Ammunation etc.) are now being saved and loaded from database.
- Bans now include serverside information; Can be viewed at http://havocserver.com/bans
- Account IDs rather than playernames are now being used for internal data handlers.
- Players can now have an offical mapper status (/mappers).
- Namechanges are now attached to the account id rather than the name to avoid confusion between different accounts.
- Playing time is now being calculated more accurate; avoiding time bugs.
- Fixed /top commands showing non-online players.
- New toy slot arrangement:
	Slot 1-4 usable by everyone, slot 5-6 VIP only.
- Enterprise/House slots now rise proportional to score:
	Needed score:      House slots:    Enterprises slots:
			 500           1                 1
			1000           2                 2
			3000           3                 3
		   10000           4                 4
		   25000           5                 5
- House system has been fully rewritten.
   * Every house now has a fix amount of PV slots which can be used to buy custom cars (private vehicles). 
   * /h now shows all of your houses (click to teleport).
   * /upgrade to upgrade your house interior.
   * /password to lock a house and set a password dialog.
   * /sellto <playerid> <price> to sell your house to another player (does not change interior).
   * Added '/accept house' to accept house offers from other players.
   * /sell to sell your house and make it buyable by every player (resets interior to it's default).
   * /spawn to set your spawn location inside your house.
   * Removed house item system.
   * /hlock has been merged into /lock.
   * /hmenu has been removed.
- Enterprise (Business) changes:
   * Businesses have been renamed to Enterprises.
   * Added new type: Bitcoin Mining Farm.
   * /e for a list of your enterprises (click to teleport).
   * Enterpries now have a value like houses.
   * /sellto <playerid> <price> to sell your enterprise to another player (does not change level).
   * Using /sell resets the enterprise level to 1.
   * Added '/accept enterprise' to to accept an enterprise offer from another player.
- Merged old /accept command into '/accept vip'
- Removed bullet hit sound from deathmatches.
- Renamed /toggletp to /tgo.
- Renamed /specoff to /unspec.
- Renamed /gsetrank to /grank.
- Removed /locate. Now redirects to /id.
- /sell /buy can now be used for houses and enterprises.
- You can now sell/buy houses/enterprises/custom cars on the Havoc Forums.
- Vehicle flip key has been set to key 'Y'.
- Removed Gold Credits system.
- New chat shortcuts:
  #text = Admin chat
  *text = VIP chat
  !text = Gang chat
  $$$text = Enable color codes (VIP)
- Added color codes for VIPs: <blue> <red> <green> <yellow> <white>
  Example: http://puu.sh/grYnS/0d0c51b768.jpg
  Results in: http://puu.sh/grYsF/f2503fc124.jpg  
- Command /ncrecords is now accessible by everyone.
- Houses now determine how many private vehicles you may held within your account.
- Player bounties are now being saved within your account.
- Duel wins and defeats are now being saved within your account.
- Derby: Each map has it's own vehicle for all players.
- New /settings dialog values which are being saved in the database:
  * /tgo (Allow teleports to you)
  * /tpm (Allow private messages)
  * /fs (Fight style, now in a dialog)
  * /speedo (Vehicle speedometer)
  * Prefered name color
  * Prefered skin
  * Auto Login
  * /blevel (severity of vehicle boost)
  * /jlevel (severity of vehicle jumps)
  * Join message (VIP only)
  * Spawn location (House/Hotspot) 
- Removed dialog/teleport sounds.
- Removed dynamic ramps.
- Removed godmode textdraw.
- Code improvements.

Gameplay changes made possible by SA-MP 0.3.7
- Sold house icon color has been changed to red
- Vehicle collisions are now disabled in the /race minigame
- Clear dialogs with TABs, for example: /h

Admin changelog:
- Renamed /togglegc to /tgc.
- /caps command has been removed.
- Removed /scorefall, /cashfall and announce commands.
- Added /setmapper command.

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
- Spawnpoints have been remapped.
- All teleports have been retaken for a better gameplay experience.
- Airport maps have been improved to make it possible to lift off with a plane.
- Gang score has been reduced if you attack a zone with many members.
- Got rid of mSelection, now using an improved UI for toys.
- Improve OnPlayerKeyStateChange and remove shitty doingStunt stuff