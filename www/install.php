


<?php

$dsn = "mysql:host=db;dbname=test";

$user = "root";
$passwd = "123456";

$pdo = new PDO($dsn, $user, $passwd);

$stm = $pdo->query("SELECT VERSION()");

$version = $stm->fetch();
echo "here".$dsn;
echo $version[0] . PHP_EOL;