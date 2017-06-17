<html>
<head>
<?php
//bygokhangobus
$servername = 'localhost';
$username = 'root';
$password = 'mysql';

$database = 'gokhan_gobus';

$district=$_POST["district"];
// Create connection
$conn = new mysqli($servername,$username,$password,$database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
} 

//echo "<br>Connected successfully<br>";

$sql ="SELECT city_name,city_id FROM CITY WHERE district_id='$district';";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    $i=0;
    while($row = $result->fetch_assoc()) {
        //her biri arraya giriyo
        $cname[$i]=$row["city_name"];
        $cid[$i]=$row["city_id"];
        $i++;
    }
} else {
    
}
$conn->close();

?>

</head>
<body>
<a href="../Demo.php">Demo</a><a>>></a><a href="QADistrict.php">QA-District</a><a>>></a><a>QA-City</a><hr><br><br>




<form action="ShowCitySalesInformation.php" method="post">
SELECT A CITY: <select name="city" >
	<?php
		for($x = 0; $x < $i; $x++) {
    		if ($ss == $cname[$x]){
    			 $selected = ' selected="selected"';
    		}
    		print('<option value="'.($cid[$x]).'"'.$selected.'>'.$cname[$x].'</option>'."\n");
    		
		}
	?>
</select><br>
<button name="submit" type="submit" style="width:50px; height:50px;">Next</button>
</form>



</body>
</html>