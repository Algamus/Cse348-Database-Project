<html>
<head>
<?php
//bygokhangobus
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

$sql ="SELECT district_name,district_id FROM DISTRICT  ";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    $i=0;
    while($row = $result->fetch_assoc()) {
        //her biri arraya giriyo
        $dname[$i]=$row["district_name"];
        $did[$i]=$row["district_id"];
        $i++;
    }
} else {
    
}
$conn->close();

?>

</head>
<body>
<a href="../Demo.php">Demo</a><a>>></a><a>QB-District</a><hr><br>






<form action="QBCity.php" method="post">
SELECT A DISTRICT: <select name="district" >
	<?php
		for($x = 0; $x < $i; $x++) {
    		if ($ss == $dname[$x]){
    			 $selected = ' selected="selected"';
    		}
    		print('<option value="'.($did[$x]).'"'.$selected.'>'.$dname[$x].'</option>'."\n");
    		
		}
	?>
</select><br>
<button name="submit" type="submit" style="width:50px; height:50px;">Next</button>
</form>



</body>
</html>