<html>
  <head>
    <title>Wines Result Page</title>
  </head>
  <body>
    
    
<?php
      // Open the database connection
      require_once('db.php');
	  if(!$connection = mysql_connect(DB_HOST, DB_USER, DB_PW)){
		echo 'Could not connect to mysql on ' . DB_HOST . "\n";
		exit;
	  }
	  else{
      $connection = mysql_connect(DB_HOST, DB_USER, DB_PW);
      mysql_select_db("winestore", $connection);
	  }

	  echo "<table width='900' cellpadding='7' cellspacing='5' border='2'>";
		//depending on your own parameters of course, but the values must be in single quotes
		echo "<tr><td>Name</td><td>Variety</td><td>Year</td><td>Winery</td><td>Region</td><td>Cose</td><td>Total number</td><td>Total stock</td><td>Total revenue</td></tr>";
		//you can do this for as many rows as you like
		echo "</table>";
		//this ends your table

      //Close the database connection
      mysql_close($connection);

?>

  </body>
</html>