# event-gameservers  
Documentation for using gameservers on events  
  
in this example we use two servers; 1 gameserver and 1 webserver  
note all your IP information beforehand  
##### run this on your webserver:
  
##### get the files  
`git clone https://github.com/Eddie1337/gameservers-event.git`   
`cd Docker-BGPanel`   
  
  
##### Add confomator mysql password
add mysql user for config automator (confomator) use environment parameter?  
change Dockerfile line 46 to your password  
##### build the container
build the container: upload to hub.docker ?  
`docker build --tag bgpanel:1.0 .`   
start the container  
`docker run --name "bgpanel" -p 31337:80 -p 3308:3306 bgpanel:1.0`  
##### bgpanel
If no errors are show, go to your bgpanel URL  
in this example we use a proxy trough port 31337 to add ssl support to bgpanel and 3308 for mysql  
in this example bgpanel url = gamepanel.domain.tld   
navigate to bgpanel url and enter all your gameserver IP information. Please note the BOX id's, server IP's and gameservers in \postman\assets\csgo.xlsx  
use 1 core per gameserver if your CPU is =< Sandy Bridge  
the csgo server instances use seperate folders in the following notation /home/game/csgo-00, where 00 is the instance number  
grab your tokens from https://steamcommunity.com/dev/managegameservers  
save the bgpanel tab as csv  
  
##### bgpanel postman
import the bgpanel json collection in postman  
grab your session cookies and insert them in the postman collection  
import the csv using the Postman runner  
note the gameserver id's for later use to validate the gameservers  
  
  
## confomator
  
`cd BGPanel-DCD`   
`composer update`   
set vhost root to the index.php eg. comfomator.domain.tld  
  
  
##### Workings
`php configGetter.php` does a request to the index.php of the generator.    
DCD checks the RemoteADDR of the request and links a BGPanel Box.    
DCD returns a json encoded string with all the configfiles + paths.     
ConfigGetter does a callback at the end of the run, with the success/error rate  
  
##### Dashboard

Goto https://{$url}/dashboard.php to get a overview of the Boxes and status of config callbacks  
  
  
Edit src/BGPanel/Db.php  
  
set the Mysql credentials to the BGPanel Database  
  
  
### Add config for game
  
1. Create a GameConfig php in `src/GameConfig`. copy for example CSGO.php  
2. Add bgpanel 'gameid' to the switchcase in `ConfigBuilder::getByBGGameId()` function, and map to the GameConfig create in step 1.  
3. Create a folder + template in `templates` folder. if possible use the same structure as on the gameserver in the GamePath. (if not, you can overwrite this path, look at `GameConfig/csgo.php` for example).  
4. Add all needed configFiles in .twig templates, and add those to the TemplateData array in your GameConfig PHP.  
  
  
  
## prepare the gameservers
  
`apt install php7.2-mysql composer lib32gcc1 lib32stdc++6 steamcmd screen`   
`adduser game`   
homedir we use: /home/game/   
`git clone https://github.com/Eddie1337/gameservers-event.git`  
`chmod +x updateCsgo.sh`   
`chmod +x copyCsgo.sh`   
#if you have fast internet or lancache, run updateCsgo.sh else run copyCsgo.sh  
#if you want to save diskspace, use symbolic links for the vdf files  
#if you have tips for using one base dir, let me know?  
  
## Automatic config Deployment to gameservers  
Running the ConfigGetter in cronjob to fetch and apply the latest configs  
  
`cd BGPanel-DCD`   
`composer update`   
  
Edit ConfigGetter.php  
  
`private static $dcdConfigUrl = ''` to the URL the DCD configGenerator is running   
  
Add CronJob:  
  
`* * * * * flock -n /tmp/dcd-deployment.lock -c "/usr/bin/php /home/game/BGPanel-DCD/ConfigGetter.php >> /home/game/dcd-configgetter.log 2>&1"`   
  
Test/Debug:  
  
`php configGetter.php debug` to enable debugOutput + skip random sleep  
  
return to postman and run the validateGameServer collection using a csv with the gameservers ID you've noted earlier  
  
Go to your bgpanel URL and check if the servers are able to start  
export the HLSW tab \postman\assets\csgo.xlsx to a txt file  
Import the txt file in HLSW  
Check if the servers are online  
  
## eBot
  
`cd /docker-ebot`   
change your admins passwords and NIC IP in docker-compose.yml  
`docker-compose up -d`   
  
Login to the ebot url grab your cookie and put it in the postman collecion named eBot  
run the postman runner using the eBot tab in postman\assets\csgo.xlsx  
  
  
  
  
Great thanks to the sources i've used:  
https://github.com/jffz/docker-ebot  
https://github.com/stefankonig/BGPanel-DCD  
https://github.com/agonbar/Docker-BGPanel
