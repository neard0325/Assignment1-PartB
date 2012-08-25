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
      
      
      //region drop down list
      $query = "SELECT region_name from region";
      $result = mysql_query($query, $connection);
      
      echo "Choose a region:";
      echo '<select>';
        while ($row = mysql_fetch_array($result)){
            for($i = 0; $i<mysql_num_fields($result);$i++){
              echo "<option value = '$row[$i]'>$row[$i]</option>";
            }
        }
      echo '</select>';
      echo "<br />";
      echo "<br />";
      
      //variety drop down list
      $query2 = "SELECT variety from grape_variety";
      $result2 = mysql_query($query2, $connection);
      
      echo "Choose a grape variety:";
      echo '<select>';
        while ($row2 = mysql_fetch_array($result2)){
            for($i = 0;$i<mysql_num_fields($result2);$i++){
              echo "<option value = 'row2[$i]'>$row2[$i]</option>";
            }
        }
      echo '</select>';
      echo "<br />";
      echo "<br />";
      
      //start year drop down list
      $query3 = "SELECT distinct year from wine order by year asc";
      $result3 = mysql_query($query3, $connection);
      
      echo "Choose a start year:";
      echo '<select>';
        while ($row3 = mysql_fetch_array($result3)){
            for($i = 0;$i<mysql_num_fields($result3);$i++){
              echo "<option value = 'row3[$i]'>$row3[$i]</option>";
            }
        }
      echo '</select>';
      echo "<br />";
      echo "<br />";
      
      //end year drop down list
      $query4 = "SELECT distinct year from wine order by year asc";
      $result4 = mysql_query($query4, $connection);
      
      echo "Choose a end year:";
      echo '<select>';
        while ($row4 = mysql_fetch_array($result4)){
            for($i = 0;$i<mysql_num_fields($result4);$i++){
              echo "<option value = 'row4[$i]'>$row4[$i]</option>";
            }
        }
      echo '</select>';
      echo "<br />";
      echo "<br />";
      
      
      //Close the database connection
      mysql_close($connection);

?>
      <input type ="submit" value = "Search" name ="submit" id ="submit"/> <br />
    </form>
  </body>
</html>