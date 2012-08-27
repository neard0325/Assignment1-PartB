<html>
  <head>
    <title>Wines Result Page</title>
  </head>
  <body>
    
    
<?php

	  function showerror() {
			die("Error " . mysql_errno() . " : " . mysql_error());
	  }
      // Open the database connection
      require_once('db.php');
	  $connection = mysql_connect(DB_HOST, DB_USER, DB_PW);
	  mysql_select_db('winestore', $connection);

	  //table create
	  function display_table($connection, $query){
	  // Run the query on the server
	  if(!($result = @ mysql_query($query, $connection))){
			showerror();
			echo "<br>";
	  }
	  // Find out how many rows are available
	  $rowFound = @ mysql_num_rows($result);

	  if($rowFound > 0){
		echo "Search Result as below";
		echo "<br>";
		echo $rowFound . " datas found in database";

		echo "<table width='1250' cellpadding='5' cellspacing='5' border='2'>";
		echo "<tr><td width = '150'><b>Name</b></td>
				  <td width = '100'><b>Variety</b></td>
				  <td width = '100'><b>Year</b></td>
				  <td width = '200'><b>Winery</b></td>
				  <td width = '200'><b>Region</b></td>
				  <td width = '100'><b>Cost</b></td>
				  <td width = '150'><b>Total number</b></td>
				  <td width = '100'><b>Total stock</b></td>
				  <td width = '150'><b>Total revenue</b></td></tr>";

			while($row = @ mysql_fetch_array($result)){
				echo "<tr><td width = '150'>{$row["wine_name"]}</td>
						  <td width = '100'>{$row["variety"]}</td>
						  <td width = '100'>{$row["year"]}</td>
						  <td width = '200'>{$row["winery_name"]}</td>
						  <td width = '200'>{$row["region_name"]}</td>
						  <td width = '100'>{$row["cost"]}</td>
						  <td width = '150'>{$row["sum(qty)"]}</td>
						  <td width = '100'>{$row["on_hand"]}</td>
						  <td width = '150'>{$row["sum(price)"]}</td>
						  </tr>";
			}
		echo "</table>";
		}
		else{
			echo " No matched record";
		}
	   }

	   if (!($connection = @ mysql_connect(DB_HOST, DB_USER, DB_PW))) {
			die("Could not connect");
	   }

		$query = "SELECT wine_name, variety, year, winery_name, region_name, cost, sum(qty), on_hand, sum(price)
          From wine, grape_variety, winery, region, inventory, items, wine_variety , orders
		  Where wine.winery_id = winery.winery_id
		    And winery.region_id = region.region_id
			And inventory.wine_id = wine.wine_id
			And wine.wine_id = items.wine_id
			And wine.wine_id = wine_variety.wine_id
			And grape_variety.variety_id = wine_variety.variety_id
			And items.order_id = orders.order_id
			And items.cust_id = orders.cust_id";


		$WineName = $_GET['WineName'];
		$GrapeVariety = $_GET['GrapeVariety'];
		$StartYear = intval($_GET['StartYear']);
		$EndYear = intval($_GET['EndYear']);
		$WineryName = $_GET['WineryName'];
		$RegionName = $_GET['RegionName'];
		$MinStock = intval($_GET['MinStock']);
		$MinOrder = intval($_GET['MinOrder']);
		$MinCost = intval($_GET['MinCost']);
		$MaxCost = intval($_GET['MaxCost']);

		if($MinCost > $MaxCost){
			die("Mincost is bigger than Maxcost");
		}
		if($StartYear > $EndYear){
			die("Startyear is later than Endyear");
		}

		if (isset($RegionName) && ($RegionName != "All")) {
			$query .= " AND region_name like '{$RegionName}%'";
		}
		if (isset($WineName) && !empty($WineName)) {
			$query .= " AND wine_name like '{$WineName}%'";
		}
  
		if (isset($WineryName) && !empty($WineryName)) {
			$query .= " AND winery_name like '{$WineryName}%'";
		}
  
		if (isset($GrapeVariety) && !empty($GrapeVariety)) {
			$query .= " AND variety = '{$GrapeVariety}'";
		}
  
		if (isset($StartYear) && isset($EndYear) &&$StartYear < $EndYear) {
			$query .= " AND year between '{$StartYear}' and '{$EndYear}'";
		}

		if (isset($MinStock) && !empty($MinStock)) {
			$query .= " AND on_hand > '{$MinStock}'";
		}

		if (isset($MinOrder) && !empty($MinOrder)) {
			$query .= " AND qty > '{$MinOrder}'";
		}

		if (isset($MinCost) && !empty($MinCost) && isset($MaxCost) && !empty($MaxCost)){
			$query .= " AND cost between '{$MinCost}' and '{$MaxCost}'";
		}

		$query .= " GROUP BY wine.wine_id";
		$query .= " ORDER BY wine.wine_name";

	 display_table($connection, $query);


?>

  </body>
</html>