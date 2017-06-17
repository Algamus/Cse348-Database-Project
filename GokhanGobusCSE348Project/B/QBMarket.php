<html>
<head>
<?php
//bygokhangobus
$servername = 'localhost';
$username = 'root';
$password = 'mysql';

$database = 'gokhan_gobus';

$city=$_POST["city"];
// Create connection
$conn = new mysqli($servername,$username,$password,$database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
} 

//echo "<br>Connected successfully<br>";

$sql ="SELECT market_name,market_id FROM MARKET WHERE city_id='$city';";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    $i=0;
    while($row = $result->fetch_assoc()) {
        //her biri arraya giriyo
        $mname[$i]=$row["market_name"];
        $mid[$i]=$row["market_id"];
        $i++;
    }
} else {
    
}
$conn->close();

?>

</head>
<body>
<a href="../Demo.php">Demo</a><a>>></a><a href="QBDistrict.php">QB-District</a><a>>></a><a>QB-City</a><a>>></a><a>QB-Market</a><hr><br>






<form action="MarketSalesInformation.php" method="post">
SELECT A MARKET: <select name="market" >
	<?php
		for($x = 0; $x < $i; $x++) {
    		if ($ss == $mname[$x]){
    			 $selected = ' selected="selected"';
    		}
    		print('<option value="'.($mid[$x]).'"'.$selected.'>'.$mname[$x].'</option>'."\n");
    		
		}
	?>
</select><br>
<button name="submit" type="submit" style="width:50px; height:50px;">Next</button>
</form>



</body>
</html>