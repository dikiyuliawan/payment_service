<?php

define('HOST', 'localhost');
define('USER', 'root');
define('DB', 'payment_services');
define('PASS', '');

$conn = new mysqli(HOST, USER, PASS, DB) or die("Connection error to access database");
