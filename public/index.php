<?php
session_status();
define('CHKINCLUDE', true);
require_once(__DIR__ . '/../inc/bootstrap/bootstrap.php');

$check = 'contact@globalgeek.net';
mailAccountsCheckExists($check);

