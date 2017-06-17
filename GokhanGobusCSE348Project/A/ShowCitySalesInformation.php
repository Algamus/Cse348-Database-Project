<html>
<head>
<?php
//bygokhangobus
$servername = 'localhost';
$username = 'root';
$password = 'mysql';
$database = 'gokhan_gobus';

$city=$_POST["city"];// onceki phpden city id geliyor.

// Create connection
$conn = new mysqli($servername,$username,$password,$database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
} 

//echo "<br>Connected successfully<br>";

$sql ="SELECT market_id,market_name FROM MARKET WHERE city_id='$city';";//marketid ve nameleri alıncak

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    $i=0;
    while($row = $result->fetch_assoc()) {
        //her biri arraya giriyo
        $mid[$i]=$row["market_id"];
        $mname[$i]=$row["market_name"];
        $i++;
    }
} else {
    
}

$sql ="SELECT  COUNT(T1.sales_id) AS total FROM SALES AS T1 RIGHT JOIN SALESMAN AS T2 ON T1.salesman_id=T2.salesman_id RIGHT JOIN MARKET AS T3 ON T2.market_id=T3.market_id WHERE T3.city_id='$city';";// total sale alınıyor

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //her biri arraya giriyo
        $sum=$row["total"];
        
    }
} else {
    
}

$max=0;

for($k=0;$k<$i;$k++){
$temp=$mid[$k];
$sql ="SELECT  COUNT(T1.sales_id) AS total FROM SALES AS T1 RIGHT JOIN SALESMAN AS T2 ON T1.salesman_id=T2.salesman_id RIGHT JOIN MARKET AS T3 ON T2.market_id=T3.market_id WHERE T3.market_id='$temp';"; //her bir marketin bireysel sale sayısı alınıyor

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //her biri arraya giriyo
        $s[$k]=$row["total"];
        if($max<$s[$k]){
            $max=$s[$k];
        }
    }
} else {
    
}

}
$conn->close();

for($i=0;$i<5;$i++){
        $percent[$i]= round(($s[$i] / $max) * 100,0);
}

?>

<style type="text/css">
    .outter{
        height:25px;
        width:100px;
        border:solid 1px #000;
    }
    .inner{
        height:25px;
        width:0px;
        border-right:solid 1px #000;
        background-color:lightblue;
    }
</style>

</head>
<body>
<a href="../Demo.php">Demo</a><a>>></a><a href="QADistrict.php">QA-District</a><a>>></a><a>QB-City</a><a>>></a><a>ShowCitySalesInformation</a><hr><br>
<?php

    echo 'Total product sale in this city:'.$sum.'<br>';
    
    for($i=0;$i<5;$i++){

        echo '<br>'.$mname[$i].':'.str_repeat('&nbsp;', 5).$s[$i].'&nbsp&nbspproduct sold.'.'<div class="outter"><div class="inner" style="width:'.$percent[$i].'px">'.str_repeat('&nbsp;', 5).$percent[$i].'%</div></div>';


    }
?>
</body>
</html>