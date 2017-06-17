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




$sql ="SELECT  COUNT(T1.sales_id) AS total FROM SALES AS T1 RIGHT JOIN SALESMAN AS T2 ON T1.salesman_id=T2.salesman_id WHERE T2.market_id='$market';";

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
for($i=1;$i<=200;$i++){
    $sql ="SELECT  COUNT(T1.sales_id) AS total ,T2.product_name AS product_name FROM SALES AS T1 RIGHT JOIN PRODUCT AS T2 ON T1.product_id=T2.product_id RIGHT JOIN SALESMAN AS T3 ON T1.salesman_id=T3.salesman_id WHERE T1.product_id='$i' AND T3.market_id='$market';";//sum

    $result = $conn->query($sql);

    
    if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {
        //her biri arraya giriyo
        $psold[($i)-1]=$row["total"];
        $pname[($i)-1]=$row["product_name"];   
    }
    if( $max < $psold[($i)-1] ){
            $max=$psold[($i)-1];
    }
} else {
    
}



}



$conn->close();

for($i=0;$i<200;$i++){
        $percent[$i]= round(($psold[$i] / $max) * 100,0);
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
<a href="../Demo.php">Demo</a><a>>></a><a href="QBDistrict.php">QB-District</a><a>>></a><a>QB-City</a><a>>></a><a>MarketSalesInformation</a><a>>></a><a>Productreport</a><hr><br>

<?php
 echo '<br>Total product sale:'.$sum.'<br>';

    for($i=0;$i<200;$i++){
        if($psold[$i]!=0){
            echo '<br>'.$pname[$i].':'.str_repeat('&nbsp;', 5).$psold[$i].'&nbspproduct&nbspsold<div class="outter"><div class="inner" style="width:'.$percent[$i].'px">'.str_repeat('&nbsp;', 5).$percent[$i].'%</div></div><br>';
        }
    }



?>


</body>
</html>