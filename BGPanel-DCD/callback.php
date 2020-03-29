<?php
require 'vendor/autoload.php';

use BGPanelDCD\ServerConfig;

// in
$remoteIp      = $_SERVER['REMOTE_ADDR'];
$totalAmount   = isset($_GET['total']) ? $_GET['total'] : -1;
$successAmount = isset($_GET['success']) ? $_GET['success'] : -1;
$errorAmount   = isset($_GET['error']) ? $_GET['error'] : -1;

// filter
$totalAmount   = intval($totalAmount);
$successAmount = intval($successAmount);
$errorAmount   = intval($errorAmount);

// compute
ServerConfig::processCallback($remoteIp, $totalAmount, $successAmount, $errorAmount);
