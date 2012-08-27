<html>
  <head>
    <title>Wines Search Page</title>
  </head>
  <body>
    <form action ="PartBresult.php" method ="GET">
      A wine name(or part of a wine name):<input type = "text" name = "WineName" value = ""/> <br /> <br />
      A winery name (or part of a winery name):<input type = "text" name = "WineryName" value = ""/> <br /> <br />
      A minimum number of wines in stock:<input type = "text" name = "MinStock" value = ""/> <br /> <br />
      A minimum number of wines ordered:<input type = "text" name = "MinOrder" value = ""/> <br /> <br />
      A minimum dollar cost range:<input type = "text" name = "MinCost" value = ""/> <br /> <br />
      A maximum dollar cost range:<input type = "text" name = "MaxCost" value = ""/> <br /> <br />
    
<?php
      // Open the database connection
      require_once('db.php');
      $connection = mysql_connect(DB_HOST, DB_USER, DB_PW);
      mysql_select_db("winestore", $connection);
      
      
      //region drop down list
      $query = "SELECT region_name from region";
      $result = mysql_query($query, $connection);
      
      echo "Choose a region:";
      echo "<select name = 'RegionName'>";
        while ($option = mysql_fetch_row($result)){
            for($i = 0; $i<mysql_num_fields($result);$i++){
              echo "<option value = '$option[$i]'>$option[$i]</option>";
            }
        }
      echo "</select>";
      echo "<br />";
      echo "<br />";
      
      //variety drop down list
      $query2 = "SELECT variety from grape_variety";
      $result2 = mysql_query($query2, $connection);
      
      echo "Choose a grape variety:";
      echo "<select name = 'GrapeVariety'>";
        while ($option1 = mysql_fetch_row($result2)){
            for($i = 0; $i<mysql_num_fields($result2);$i++){
              echo "<option value = '$option1[$i]'>$option1[$i]</option>";
            }
        }
      echo "</select>";
      echo "<br />";
      echo "<br />";
      
      //start year drop down list
      $query3 = "SELECT distinct year from wine order by year asc";
      $result3 = mysql_query($query3, $connection);
      
      echo "Choose a start year:";
      echo "<select name = 'StartYear'>";
        while ($option2 = mysql_fetch_row($result3)){
            for($i = 0; $i<mysql_num_fields($result3);$i++){
              echo "<option value = '$option2[$i]'>$option2[$i]</option>";
            }
        }
      echo "</select>";
      echo "<br />";
      echo "<br />";
      
      //end year drop down list
      $query4 = "SELECT distinct year from wine order by year desc";
      $result4 = mysql_query($query4, $connection);
      
      echo "Choose a end year:";
      echo "<select name = 'EndYear'>";
        while ($option3 = mysql_fetch_row($result4)){
            for($i = 0; $i<mysql_num_fields($result4);$i++){
              echo "<option value = '$option3[$i]'>$option3[$i]</option>";
            }
        }
      echo "</select>";
      echo "<br />";
      echo "<br />";
      
      
      //Close the database connection
      mysql_close($connection);

?>
      <input type ="submit" value = "Search" name ="submit"/> <br />
    </form>
  </body>
</html>