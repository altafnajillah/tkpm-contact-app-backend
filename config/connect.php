<?php
define('HOST', 'localhost'); // serverhost
define('USER', 'root'); // username database
define('PASS', 'root'); // password database
define('DB', 'tkpm_contact_app'); // nama database

$con = mysqli_connect(HOST, USER, PASS, DB) or die('unable to connect');
