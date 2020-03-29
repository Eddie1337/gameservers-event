<?php
require 'vendor/autoload.php';

use BGPanelDCD\BGPanel\Db;

//debugging purposes in first run
ini_set('display_errors', 1);

Db::addDCDCallBackTable();

