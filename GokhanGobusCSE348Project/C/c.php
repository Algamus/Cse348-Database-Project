<html>
<head>
  <?php
    $servername = 'localhost';
    $username = 'root';
    $password = 'mysql';
    $database = 'gokhan_gobus';

    // Create connection
    $conn = new mysqli($servername,$username,$password,$database);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: ".$conn->connect_error);
    } 

//echo "<br>Connected successfully<br>";
//a icin
$sql ="SELECT district_id,district_name FROM DISTRICT;";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    $d=0;
    while($row = $result->fetch_assoc()) {
        //her biri arraya giriyo
        $did[$d]=$row["district_id"];
        $dname[$d]=$row["district_name"];
        
        $d++;
    }
} else {
    
}
for($k=0;$k<$d;$k++){
$t=$did[$k];
$sql ="SELECT count(sales_id) AS total FROM SALES WHERE salesman_id IN (SELECT salesman_id FROM SALESMAN WHERE market_id IN (SELECT market_id FROM MARKET WHERE city_id IN (SELECT city_id FROM CITY WHERE district_id='$t')));";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //her biri arraya giriyo
        $asd[$k]=$row["total"];//allsalesdistrict
    }
} else {

}

}

//b icin
$sql ="SELECT DISTINCT market_name FROM MARKET";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    $m=0;
    while($row = $result->fetch_assoc()) {
        //her biri arraya giriyo
        $mname[$m]=$row["market_name"];
        $m++;
    }
} else {
    
}

for($k=0;$k<$m;$k++){
$t=$mname[$k];
$sql ="SELECT count(sales_id) AS total FROM SALES WHERE salesman_id IN (SELECT salesman_id FROM SALESMAN WHERE market_id IN (SELECT market_id FROM MARKET WHERE market_name='$t'));";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //her biri arraya giriyo
        $asm[$k]=$row["total"];//allsalesmarkets
    }
} else {
    
}

}

$conn->close();



     
     /* Libchart - PHP chart library
   * Copyright (C) 2005-2011 Jean-Marc Trémeaux (jm.tremeaux at gmail.com)
   * 
   * This program is free software: you can redistribute it and/or modify
   * it under the terms of the GNU General Public License as published by
   * the Free Software Foundation, either version 3 of the License, or
   * (at your option) any later version.
   * 
   * This program is distributed in the hope that it will be useful,
   * but WITHOUT ANY WARRANTY; without even the implied warranty of
   * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   * GNU General Public License for more details.
   *
   * You should have received a copy of the GNU General Public License
   * along with this program.  If not, see <http://www.gnu.org/licenses/>.
   * 
   */
  
    include "libchart/classes/libchart.php";

     $chart = new PieChart();

     $dataSet = new XYDataSet();
     for($i=0;$i<$d;$i++){
    

        $dataSet->addPoint(new Point($dname[$i].'(Sold : '.$asd[$i].')', $asd[$i]));
     }
     $chart->setDataSet($dataSet);

     $chart->setTitle("All Sales Divided Into Districts");
     $chart->render("generated/a.png");



     $chart = new PieChart();

     $dataSet = new XYDataSet();
     for($i=0;$i<$m;$i++){
        $dataSet->addPoint(new Point($mname[$i].'(Sold : '.$asm[$i].')', $asm[$i]));
     }
     $chart->setDataSet($dataSet);

     $chart->setTitle("All Sales Divided Into Markets");
     $chart->render("generated/b.png");
?>
     <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
      <a href="../Demo.php">Demo</a><a>>></a><a>c</a><hr><br>
     <img alt="Pie chart"  src="generated/a.png" style="border: 1px solid gray;"/>
     <img alt="Pie chart"  src="generated/b.png" style="border: 1px solid gray;"/>
</body>
</html>