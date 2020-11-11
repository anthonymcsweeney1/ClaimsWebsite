<?php

$sname= "databaseclaims.database.windows.net,1433";
$unmae= "azureBIS";
$password = "LokiKovex3!";

$db_name = "ClaimsSite";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}
