<html>
  <head>
    <title>Wines Result Page</title>
  </head>
  <body>
    
    
<?php
      // Open the database connection
      require_once('db.php');
      $connection = mysql_connect(DB_HOST, DB_USER, DB_PW);
      mysql_select_db("winestore", $connection);
 
      //Close the database connection
      mysql_close($connection);

?>

  </body>
</html>