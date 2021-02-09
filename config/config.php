<?php

// Turn on all errors except for notices
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);

// Specify location of config file
// Under normal circumstances I would never use a config.json file and use a .config or something else to hide the data
// But I decided to make it easy and quick
$json = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'config.json');

// Decode json to variable
$config = json_decode($json, true);

//Definitions of different paths
define( "FRONTEND_ABS_PATH", str_replace("/", DIRECTORY_SEPARATOR, $config['pathConfig']['abs_path'] ));

//Definition of classes
include_once( FRONTEND_ABS_PATH . "classes". DIRECTORY_SEPARATOR . "ElectronicItem.php" );
include_once( FRONTEND_ABS_PATH . "classes". DIRECTORY_SEPARATOR . "ElectronicItems.php" );
include_once( FRONTEND_ABS_PATH . "classes". DIRECTORY_SEPARATOR . "ConsoleItem.php" );
include_once( FRONTEND_ABS_PATH . "classes". DIRECTORY_SEPARATOR . "TelevisionItem.php" );
include_once( FRONTEND_ABS_PATH . "classes". DIRECTORY_SEPARATOR . "MicrowaveItem.php" );
include_once( FRONTEND_ABS_PATH . "classes". DIRECTORY_SEPARATOR . "ControllerItem.php" );

define("REMOTE", true);
define("WIRED", !REMOTE);