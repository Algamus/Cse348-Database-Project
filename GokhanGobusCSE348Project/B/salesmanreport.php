<html>
<head>
<?php
//bygokhangobus
$servername = 'localhost';
$username = 'root';
$password = 'mysql';

$database = 'gokhan_gobus';

$salesman=$_POST["salesman"];
// Create connection
$conn = new mysqli($servername,$username,$password,$database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
} 

//echo "<br>Connected successfully<br>";

$sql ="SELECT T1.market_name AS market_name ,T2.salesman_name AS salesman_name,T2.salesman_surname AS salesman_surname FROM MARKET AS T1 LEFT JOIN SALESMAN AS T2 ON T1.market_id=T2.market_id WHERE T2.salesman_id='$salesman';";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    
    while($row = $result->fetch_assoc()) {
        //her biri arraya giriyo
        $sname=$row["salesman_name"];
        $ssurname=$row["salesman_surname"];
        $mname=$row["market_name"];
    }
} else {
    
}


$sql ="SELECT   T1.sale_date AS sale_date ,T2.customer_name AS customer_name , T2.customer_surname AS customer_surname , T3.product_name AS product_name ,T3.product_price AS product_price FROM SALES AS T1 RIGHT JOIN CUSTOMER AS T2 ON T1.customer_id=T2.customer_id RIGHT JOIN PRODUCT AS T3 ON T1.product_id=T3.product_id  RIGHT JOIN SALESMAN AS T4 ON T1.salesman_id=T4.salesman_id WHERE T4.salesman_id='$salesman';";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    $t=0;
    while($row = $result->fetch_assoc()) {
        //her biri arraya giriyo
        $cname[$t]=$row["customer_name"];
        $csurname[$t]=$row["customer_surname"];
        $pname[$t]=$row["product_name"];
        $pprice[$t]=$row["product_price"];
        $sdate[$t]=$row["sale_date"];
        $t++;
    }
} else {
    
}


$conn->close();




?>



</head>
<body>
<a href="../Demo.php">Demo</a><a>>></a><a href="QBDistrict.php">QB-District</a><a>>></a><a >QB-City</a><a>>></a><a >QB-Market</a><a>>></a><a >MarketSalesInformation</a><a>>></a><a >salesmanreport</a><hr><br>

<?php

    echo 'Salesman of&nbsp'.$mname.':'.$sname.'&nbsp'.$ssurname.'&nbsp'.'sales informations<br><br>';
    echo '(Customer name , Customer surname , Saled Product name , Saled Product price , Sale date)<br><hr>';
   for($i=0;$i<$t;$i++){
        echo ($i+1).'-)&nbsp'.$cname[$i].'&nbsp'.$csurname[$i].'&nbsp'.$pname[$i].'&nbsp'.$pprice[$i].'TL&nbsp'.$sdate[$i].'<br>';
   }



?>


</body>
</html>