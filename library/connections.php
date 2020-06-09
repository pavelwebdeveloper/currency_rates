<?php

/* 
 * Database connections
 */
function currencyConnect() {
$server = "localhost";
$database = "currency_rates";
$user = "proxyClient";
$password = "iMi20GYnzHXRrJ9B";
$dsn = 'mysql:host=' . $server . ';dbname=' . $database;
$options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
// Create the actual connection object and assign it to a variable
try {
 $acmeLink = new PDO($dsn, $user, $password, $options);
 /* echo '$acmeLink worked successfully<br>';*/
 return $acmeLink;
} catch (PDOException $exc) {
 header('location: /conference_registration_form/view/500.php');
 exit;
}
}

$pdo = currencyConnect();
