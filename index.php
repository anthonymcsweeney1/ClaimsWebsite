

<?php

try {
  $conn = new PDO("sqlsrv:server = tcp:fyserver1.database.windows.net,1433; Database = FYP", "azureBIS", "LokiKovex3!");
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // sql to create table
  $sql = "CREATE TABLE users (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_name VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  name VARCHAR(255),
  User_Type ARCHAR(255)
  )";

  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Table Users created successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>


