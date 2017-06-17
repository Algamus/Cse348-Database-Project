<html>
<head>
<?php
//bygokhangobus
$servername = 'localhost';
$username = 'root';
$password = 'mysql';

$database = 'gokhan_gobus';

$market=$_POST["market"];
// Create connection
$conn = new mysqli($servername,$username,$password,$database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
} 

//echo "<br>Connected successfully<br>";




$sql ="SELECT DISTINCT T1.salesman_id AS salesman_id FROM SALES AS T1 RIGHT JOIN SALESMAN AS T2 ON T1.salesman_id=T2.salesman_id RIGHT JOIN MARKET AS T3 ON T2.market_id=T3.market_id WHERE T3.market_id='$market';";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    $t=0;
    while($row = $result->fetch_assoc()) {
        //her biri arraya giriyo
        $sid[$t]=$row["salesman_id"];
        $t++;
    }
} else {
    
}


$max=0;
for($i=0;$i<$t;$i++){
    $s=$sid[$i];
    $sql ="SELECT  COUNT(T1.sales_id) AS total , T2.salesman_name AS salesman_name, T2.salesman_surname AS salesman_surname FROM SALES AS T1 RIGHT JOIN SALESMAN AS T2 ON T1.salesman_id=T2.salesman_id WHERE T2.salesman_id='$s';";

    $result = $conn->query($sql);

    
    if ($result->num_rows > 0) {
    // output data of each row

        while($row = $result->fetch_assoc()) {
            //her biri arraya giriyo
            $ssold[$i]=$row["total"];
            $sname[$i]=$row["salesman_name"];
            $ssurname[$i]=$row["salesman_surname"];

        }
        if( $max < $ssold[$i] ){
            $max=$ssold[$i];
        }
    } else {
    
    }

}








$conn->close();

for($i=0;$i<$t;$i++){
    $percent[$i]= round(($ssold[$i] / $max) * 100,0);
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
<a href="../Demo.php">Demo</a><a>>></a><a href="QBDistrict.php">QB-District</a><a>>></a><a>QB-City</a><a>>></a><a>QB-Market</a><a>>></a><a>MarketSalesInformation</a><a>>></a><a>salesmansreport</a><hr><br>

<?php

    for($i=0;$i<$t;$i++){
        if($ssold[$i]!=0){
            echo '<br>'.$sname[$i].'&nbsp'.$ssurname[$i].str_repeat('&nbsp;', 5).':&nbsp'.$ssold[$i].'&nbspproduct&nbspsold.<div class="outter"><div class="inner" style="width:'.$percent[$i].'px">'.str_repeat('&nbsp;', 5).$percent[$i].'%</div></div>';
        }
    }



?>


</body>
</html>