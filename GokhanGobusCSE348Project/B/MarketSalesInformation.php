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

$sql ="SELECT salesman_name,salesman_surname,salesman_id FROM SALESMAN WHERE market_id='$market';";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    $i=0;
    while($row = $result->fetch_assoc()) {
        //her biri arraya giriyo
        $sid[$i]=$row["salesman_id"];
        $sname[$i]=$row["salesman_name"]." ".$row["salesman_surname"];
        $i++;
    }
} else {
    
}
$conn->close();

?>

</head>
<body>
<a href="../Demo.php">Demo</a><a>>></a><a href="QBDistrict.php">QB-District</a><a>>></a><a>QB-City</a><a>>></a><a>QB-Market</a><a>>></a><a>MarketSalesInformation</a><hr><br>


<form method="post" action="productreport.php">
<input type="hidden" name="market" value= <?php echo $market; ?> >
<input type="submit" value="product button" name="submit" style="width:250px; height:50px;">&nbspHangi &nbspurun &nbspkac &nbspkere &nbspsatilmis.
</form>

<form method="post" action="salesmansreport.php">
<input type="hidden" name="market" value= <?php echo $market; ?> >
<input type="submit" value="salesmans button" name="submit" style="width:250px; height:50px;">&nbspSaticilar&nbsptoplamda&nbspkac&nbspurun&nbspsatmis(bireysel).
</form>

<form method="post" action="salesmanreport.php">
Select a Salesman: <select name="salesman" >
    <?php
        for($x = 0; $x < $i; $x++) {
            if ($ss == $sid[$x]){
                 $selected = ' selected="selected"';
            }
            print('<option value="'.($sid[$x]).'"'.$selected.'>'.$sname[$x].'</option>'."\n");
            
        }
    ?>
</select><br>
<input type="submit" value="the salesman button" name="submit" style="width:250px; height:50px;">&nbspSecili&nbspsaticinin&nbspsatis&nbspbilgisi.
</form>

<form method="post" action="invoicereport.php">
<input type="hidden" name="market" value= <?php echo $market; ?> >
<input type="submit" value="invoice button" name="submit" style="width:250px; height:50px;">&nbspbu&nbspmarketden&nbspalisveris&nbspyapmis&nbspsecilecek&nbspmusterinin&nbspgenel&nbspfaturasi.
</form>


</body>
</html>