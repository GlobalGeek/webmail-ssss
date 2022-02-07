<?php
//Require config file
require_once(__DIR__ . '/../../config/.config.php') or die("No config file");

//Require cPanel UAPI class
require('class/cpaneluapi.class.php');
//instantiate cPanel UAPI class
$s4_cPanel = new cpanelAPI('', '', '');