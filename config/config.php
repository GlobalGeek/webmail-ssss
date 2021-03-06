<?php
######################################################
##IMPORTANT:                                         #
##Set the configuration details within this file     #
##Rename this file from "config.php" to ".config.php"#
######################################################
## Database details #
#####################
define('S4CFG_DBHOST', 'localhost');            //Database host address
define('S4CFG_DBUSER', 'root');                 //Database username
define('S4CFG_DBPASS', '');                     //Database password
define('S4CFG_DBNAME', 'webmail_ssss');         //Database name

###################
## cPanel details #
###################
define('S4CFG_CPHOST', 'cpanel.example.com');   //cPanel host address
define('S4CFG_CPUSER', 'cpanelUsername');       //cPanel user name
define('S4CFG_CPPASS', 'cpanelPassword');       //cPanel password

define('S4CFG_DOMAIN', 'example.com');          //Email domain


##################################################
## Dont change unless you know what you're doing #
##################################################
define('S4CFG_SYSHASH', 'sha512');
define('S4CFG_FWDSYSTEM', 'fwd');               //fwd, system, pipe