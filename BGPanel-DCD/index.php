<?php
require 'vendor/autoload.php';

use BGPanelDCD\ServerConfig;

// in
$getIp    = isset($_GET['ip']) ? $_GET['ip'] : '';
$remoteIp = $_SERVER['REMOTE_ADDR'];

// check if ip and override remoteIp, for debugging
if (filter_var($getIp, FILTER_VALIDATE_IP)) {
    $remoteIp = $getIp;
}

// compute
$configs        = ServerConfig::getConfigsByRemoteIp($remoteIp);
$encodedConfigs = json_encode($configs, JSON_PRETTY_PRINT);

// out
header("Content-type:application/json");
echo $encodedConfigs;

