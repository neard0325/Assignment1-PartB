<html>
<head>
<title>Wines(PartB)</title>
</head>
<body>
<?php
  require_once('db.php');

  // (1) Open the database connection
  $connection = mysql_connect(DB_HOST, DB_USER, DB_PW);
  mysql_select_db("winestore", $connection);








  // (4) Close the database connection
  mysql_close($connection);
?>
</body>
</html>
