<html>
  <head>
    <title>Wines Search Page</title>
  </head>
  <body>
    <form action ="PartBresult.php" method ="GET">
      A wine name(or part of a wine name):<input type = "text" name = "wine_name" id = "wine_name" /> <br /> <br />
      A winery name (or part of a winery name):<input type = "text" name = "winery_name" id = "winery_name" /> <br /> <br />
      A minimum number of wines in stock:<input type = "text" name = "min_stock" id = "min_stock"/> <br /> <br />
      A minimum number of wines ordered:<input type = "text" name = "min_order" id = "min_order"/> <br /> <br />
      A minimum dollar cost range:<input type = "text" name = "min_cost" id = "mincost"/> <br /> <br />
      A maximum dollar cost range:<input type = "text" name = "max_cost" id = "maxcost"/> <br /> <br />
    
<?php
      // Open the database connection
      require_once('db.php');
      $connection = mysql_connect(DB_HOST, DB_USER, DB_PW);
      mysql_select_db("winestore", $connection);
      
      $query = "SELECT region_name from region";
      $result = mysql_query($query, $connection);
      
      echo "Choose a region:";
      echo '<select>';
        while ($row = mysql_fetch_row($result)){
            for($i = 0; $i < mysql_num_fields($result); $i++){
              echo "<option value = '$row[$i]'>$row[$i]</option>";
            }
        }
      echo '</select>';
      echo "<br />";
      
      
      //Close the database connection
      mysql_close($connection);

?>
      <input type ="submit" value = "Search" /> <br />
    </form>
  </body>
</html>