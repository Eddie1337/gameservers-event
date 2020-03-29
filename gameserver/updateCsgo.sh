#!/bin/bash
for i in {01..40}
do
 steamcmd +login anonymous +force_install_dir /home/game/csgo-$i +app_update 740 validate +exit
done
