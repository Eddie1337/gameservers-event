# Bright Gamepanel config generator 
Basic config generation with twig templates and variables from BGPanel Database.

as always: all comes as is, NxSLA

##### Workings:
`php configGetter.php` does a request to the index.php of the generator.<br>
DCD checks the RemoteADDR of the request and links a BGPanel Box.<br>
DCD returns a json encoded string with all the configfiles + paths. <br>
ConfigGetter does a callback at the end of the run, with the success/error rate

##### Dashboard 

Goto https://{$url}/dashboard.php to get a overview of the Boxes and status of config callbacks

##### Generator system requirements:

* PHP 7.0 or higher + Composer
* Run https://{$url}/setup.php to add Callback table to BGPanelDB

##### Deployment system requirements:

* PHP 5.6 or higher
* Debian/Ubuntu (for example cronjob command)


## Config generator (DCD)

* git clone this repo
* run `composer update`
* set vhost root to the index.php

Edit src/BGPanel/Db.php

set the Mysql credentials to the BGPanel Database


## Automatic Deployment to gameservers
Running the ConfigGetter in cronjob to fetch and apply the latest configs

Edit ConfigGetter.php

`private static $dcdConfigUrl = ''` to the URL the DCD configGenerator is running 

Add CronJob:

`* * * * * flock -n /tmp/dcd-deployment.lock -c "/usr/bin/php /home/game/BGPanel-DCD/ConfigGetter.php >> /home/game/dcd-configgetter.log 2>&1"`

Test/Debug:

`php configGetter.php debug` to enable debugOutput + skip random sleep


## Lil manual

### Add config for game

1. Create a GameConfig php in `src/GameConfig`. copy for example CSGO.php
2. Add bgpanel 'gameid' to the switchcase in `ConfigBuilder::getByBGGameId()` function, and map to the GameConfig create in step 1.
3. Create a folder + template in `templates` folder. if possible use the same structure as on the gameserver in the GamePath. (if not, you can overwrite this path, look at `GameConfig/CoD4.php` for example).
4. Add all needed configFiles in .twig templates, and add those to the TemplateData array in your GameConfig PHP.
