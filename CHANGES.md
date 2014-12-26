Havoc Freeroam SA-MP Server
===========================

1.00 (1st Feb 2015)
-------------------
- Businesses have been renamed to Enterprises.
- Added enterprise type: Bitcoin Mining Farm.
- More accurate unixtime conversion.
- Dialog cleanups to avoid unnecessary overhead.
- Removed announce commands for admins.
- Removed bullet hit sound from deathmatches.
- Renamed /toggletp to /tgo.
- Renamed /bmenu to /emenu.
- Renamed /specoff to /unspec.
- Renamed /gsetrank to /grank.
- Stores system has been rewritten. Stores now load and save from database.
- Bans now include serverside information; Can be viewed at https://havocserver.com/bans
- Account IDs rather than playernames are now being used for internal data handlers.
- Players can now have an offical mapper status (/mappers).
- Namechanges are now attached to an account id rather than a name. This prevents confusion.
- House system has been fully rewritten.
  * Every player can now own up to 5 houses:
    Needed score:      Allowed houses:
             500       1
	  	    2000       2
	  	    5000       3
		   10000       4
		   25000       5
   * /hlock has been merged into /lock
   * /hmenu has been removed
   * /houses now shows all of your houses, select to teleports
   * /upgrade to upgrade your house interior
   * Command /password to lock a house and set a password dialog
   * Command /sellto <player id> <price> to sell your house to another player
  

TODO
----
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

- Remove /locate?
- Internal safetly handlers for score and money ranges.
- Improved spawn points to be more safe for players.
- Duel wins and defeats are now being saved within your account.
- Time bans are now being deleted automatically upon expiration.
- /sell /buy can now be used for houses and enterprises.
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
- /settings is now being saved in the database.
- Many new /settings options 
- Airport maps have been improved to make it possible to lift off with a plane.
- Gang score has been reduced if you attack a zone with many members.
- Houses now determine how many private cars you may held within your account.
- You can now sell/buy houses/enterprises/pvs on the Havoc forums.
- Got rid of mSelection, now using an improved UI for toys.
- Set the maximum attached player objects to 8.