# Bright Game Panel

Launches a Apache server with Bright Game Panel (and mysql)

# Instructions

If you use tutum, just press this button:

[![Deploy to Tutum](https://s.tutum.co/deploy-to-tutum.svg)](https://dashboard.tutum.co/stack/deploy/?repo=https://github.com/agonbar/Docker-BGPanel)

Using the normal docker commands, first run this
```
docker run --name "bgppanel" -p 80:80 agonbar/bgpanel
```

Then navigate to the server URL and finish the installation, once it asks to remove the install folder, restart the dock

```
docker restart bgpanel
```


Refresh the page, and it should be finished, remember to change the default admin:password
