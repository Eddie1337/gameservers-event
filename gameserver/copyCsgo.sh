#!/bin/bash
 steamcmd +login anonymous +force_install_dir /home/game/csgo +app_update 740 validate +exit
for i in {01..40}
do
 cp -ruv csgo csgo-$i
done
