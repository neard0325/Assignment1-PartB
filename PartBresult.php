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

	  //table create
	  function display_table($connection, $query){

	  $result_list = mysql_query($query, $connection);
	  $rowFound = mysql_num_rows($result_list);

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

			while($row = @ mysql_fetch_array($result_list)){
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

		$query = "Select wine_name, variety, year, winery_name, region_name, cost, sum(qty), on_hand, sum(price)
          From wine, grape_variety, winery, region, inventory, items, wine_variety
		  Where wine.winery_id = winery.winery_id
		    And winery.region_id = region.region_id
			And inventory.wine_id = wine.wine_id
			And wine.wine_id = items.wine_id
			And wine.wine_id = wine_variety.wine_id
			And grape_variety.variety_id = wine_variety.variety_id";


		$wine_name = $_GET['wine_name'];
		if(!empty($wine_name)){
			$query .= " AND wine_name LIKE '%wine_name%'";
		}

		$grape_variety = $_GET['grape_variety'];
		if(!empty($grape_variety)){
			$query .= " AND variety = '$grape_variety'";
		}

		$start_year = $_GET['start_year'];
		$end_year = $_GET['end_year'];
		if(!empty($start_year) && !empty($end_year)){
			$query .= " AND year between $start_year and $end_year";
		}

		$winery_name = $_GET['winery_name'];
		if(!empty($winery_name)){
			$query .= " AND winery_name LIKE '%winery_name%'";
		}

		$region_name = $_GET['region_name'];
		if(!empty($region_name)){
			$query .= " AND region = '$region_name'";
		}

		$min_stock = $_GET['min_stock'];
		if(!empty($min_stock)){
			$query .= " AND inventory.on_hand >= $min_stock";
		}

		$min_order = $_GET['min_order'];
		if(!empty($min_order)){
			$query .= " AND item.qty >= $min_order";
		}

		$min_cost = $_GET['min_cost'];
		$max_cost = $_GET['max_cost'];
		if(!empty($min_cost) && !empty($max_cost)){
			$query .= " AND (inventory.cost between '$min_cost' and '$max_cost')";
		}

		$query .= " GROUP BY wine_name";


	 
	 display_table($connection, $query);

      //Close the database connection
      mysql_close($connection);

?>

  </body>
</html>