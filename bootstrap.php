<?php
// Bootstrap with system
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once "database/Connection.php";
require_once  "shared/Helpers.php";
require_once  "shared/Constants.php";
require_once  "shared/Utils.php";

$config = require "config.php";
return  Connection::make($config['database']);