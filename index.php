<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:fyserver1.database.windows.net,1433; Database = FYP", "azureBIS", "LokiKovex3!");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "azureBIS", "pwd" => "LokiKovex3!", "Database" => "FYP", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:fyserver1.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
?>
