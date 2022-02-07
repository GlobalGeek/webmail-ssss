<?php
require('class/cpaneluapi.class.php');

$cPanel = new cpanelAPI('', '', '');

$response = $cPanel->uapi->Email->list_pops();
//echo $response->data->maximum_ftp_accounts;

echo '<pre>' . var_dump($response) . '</pre>';