<html>
<head>
<title>Wines Search Page</title>
</head>
<body>
	<form action ="PartBresult.php" method = "GET">
	Wine:<input type = "text" name = "wine_name" /> <br />
	Winery:<input type = "text" name = "winery_name" /> <br />
	Min in stock:<input type = "text" name = "min_stock" /> <br />
	Max in stock:<input type = "text" name = "max_stock" /> <br />
	Min Cost:<input type = "text" name = "min_cost" /> <br />
	Max Cost:<input type = "text" name = "max_cost" /> <br />
  
  
<?php
	require_once('db.php');

  // (1) Open the database connection
  	$connection = mysql_connect(DB_HOST, DB_USER, DB_PW);
	mysql_select_db("winestore", $connection);

  




  // (4) Close the database connection
  	mysql_close($connection);
?>
	<input type ="submit" value = "Search" /> <br />
</form>
</body>
</html>
