<html>
<head>
<?php
//bygokhangobus
$servername = 'localhost';
$username = 'root';
$password = 'mysql';

$database = 'gokhan_gobus';

$market=$_POST["market"];
$customer=$_POST["customer"];
// Create connection
$conn = new mysqli($servername,$username,$password,$database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
} 

//echo "<br>Connected successfully<br>";

$sql ="SELECT customer_name , customer_surname FROM CUSTOMER  WHERE customer_id='$customer';";//sum

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    
    while($row = $result->fetch_assoc()) {
        //her biri arraya giriyo
        $cname=$row["customer_name"];
        $csurname=$row["customer_surname"];
    }
} else {
    
}



$sql ="SELECT T2.product_name AS product_name, T2.product_price AS product_price , T1.sale_date AS sale_date FROM SALES AS T1 LEFT JOIN PRODUCT AS T2 ON T1.product_id=T2.product_id RIGHT JOIN SALESMAN AS T3 ON T1.salesman_id=T3.salesman_id RIGHT JOIN MARKET AS T4 ON T3.market_id=T4.market_id WHERE T4.market_id='$market' AND T1.customer_id='$customer';";//sum

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    $i=0;
    while($row = $result->fetch_assoc()) {
        //her biri arraya giriyo
        $pname[$i]=$row["product_name"];
        $pprice[$i]=$row["product_price"];
        $sdate[$i]=$row["sale_date"];
        $i++;
    }
} else {
    
}



$conn->close();




?>



</head>
<body>
<a href="../Demo.php">Demo</a><a>>></a><a href="QBDistrict.php">QB-District</a><a>>></a><a>QB-City</a><a>>></a><a>QB-Market</a><a>>></a><a >BB</a><a>>></a><a >invoicereport</a><hr><br>
    
    <?php
    echo 'Customer :'.$cname.'&nbsp'.$csurname.'&nbsp'.'invoice informations<br><br>';
    echo '(Sale date  , product name , product price)<br><hr>';
   for($t=0;$t<$i;$t++){
        echo ($t+1).'-)&nbsp'.$sdate[$t].'&nbsp'.$pname[$t].'&nbsp'.$pprice[$t].'TL<br>';
   }
        echo str_repeat('&nbsp;', 30).'Total :'.array_sum($pprice).'TL';
    ?>


</body>
</html>