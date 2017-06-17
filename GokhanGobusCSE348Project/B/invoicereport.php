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

$sql ="SELECT DISTINCT T2.customer_id AS customer_id,T2.customer_name AS customer_name ,T2.customer_surname AS customer_surname FROM SALES AS T1 RIGHT JOIN CUSTOMER AS T2 ON T1.customer_id=T2.customer_id RIGHT JOIN SALESMAN AS T3 ON T1.salesman_id=T3.salesman_id RIGHT JOIN MARKET AS T4 ON T3.market_id=T4.market_id WHERE T4.market_id='$market';";//sum

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    $i=0;
    while($row = $result->fetch_assoc()) {
        //her biri arraya giriyo
        $cid[$i]=$row["customer_id"];
        $cname[$i]=$row["customer_name"].'&nbsp;'.$row["customer_surname"];
        $i++;
    }
} else {
    
}



$conn->close();




?>



</head>
<body>
<a href="../Demo.php">Demo</a><a>>></a><a href="QBDistrict.php">QB-District</a><a>>></a><a >QB-City</a><a>>></a><a>QB-Market</a><a>>></a><a>MarketSalesInformation</a><a>>></a><a >invoicereport</a><hr><br>


<form method="post" action="invoicereport2.php">
Select a Customer: <select name="customer" >
    <?php
        for($x = 0; $x < $i; $x++) {
            if ($ss == $cid[$x]){
                 $selected = ' selected="selected"';
            }
            print('<option value="'.($cid[$x]).'"'.$selected.'>'.$cname[$x].'</option>'."\n");
            
        }
    ?>
</select><br>
<input type="hidden" name="market" value= <?php echo $market; ?> >
<input type="submit" value="invoice button next" name="submit" style="width:250px; height:50px;">
</form>


</body>
</html>