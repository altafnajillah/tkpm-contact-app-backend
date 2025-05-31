<?php
define('HOST', 'localhost'); // serverhost
define('USER', 'root'); // username database
define('PASS', 'bacobecce123'); // password database
define('DB', 'unsulbar_flutter'); // nama database

$con = mysqli_connect(HOST, USER, PASS, DB) or die('unable to connect');
