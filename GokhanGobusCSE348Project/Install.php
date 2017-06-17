<html>
<!--
Name : Gökhan Göbüş
Id : 280702020
Lesson : CSE 348 Section 1
E-Mail : gokhangobus@hotmail.com , gokhangobus@gmail.com ,gokhan.gobus@std.yeditepe.edu.tr
Description : Database Management Systems Project
				install php
1)gokhan_gobus database i olusturuluyor
2)gerekli tablolar databasede yaratılıyor
3)yaratılan tablolar gerekli bilgiler ile dolduruluyor
-->
<head>
	<?PHP
			FUNCTION createdatabase(){//For The DataBase
				$servername = 'localhost';
				$username = 'root';
				$password = 'mysql';
				$database = 'gokhan_gobus';

				// Create connection without databasename 
				$conn = new mysqli($servername, $username, $password);
				// Check connection
				if ($conn->connect_error) {
    				die("Connection failed: " . $conn->connect_error);
				} 


				// Create database
				$sql = "CREATE DATABASE IF NOT EXISTS $database";
				if ($conn->query($sql) === TRUE) {
    				echo "Database created.<br>";//Database gokhan_gobus successfully created
    				
				} else {
    				echo "Error creating database: " . $conn->error;
				}

				$conn->close();
			}

			FUNCTION createandfilltables(){//For The Datas
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
				
				//Creation of the tables

					//Table District
				$sql = "CREATE TABLE  IF NOT EXISTS DISTRICT
						(district_id INT NOT NULL ,
						district_name VARCHAR(50),
						PRIMARY KEY (district_id)) ENGINE=INNODB;";

					//Table City
				$sql .= "CREATE TABLE IF NOT EXISTS CITY
						(city_id INT NOT NULL AUTO_INCREMENT,
						city_name VARCHAR(50),
						district_id INT NOT NULL,
						PRIMARY KEY (city_id),
						FOREIGN KEY (district_id) REFERENCES DISTRICT(district_id) ON UPDATE CASCADE ON DELETE CASCADE) ENGINE=INNODB;";

					//Table Market
				$sql .= "CREATE TABLE IF NOT EXISTS MARKET
						(market_id INT NOT NULL AUTO_INCREMENT,
						market_name VARCHAR(50),
						city_id INT NOT NULL,
						PRIMARY KEY (market_id),
						FOREIGN KEY (city_id) REFERENCES CITY(city_id) ON UPDATE CASCADE ON DELETE CASCADE) ENGINE=INNODB;";

					//Table Product
				$sql .= "CREATE TABLE IF NOT EXISTS PRODUCT
						(product_id INT NOT NULL AUTO_INCREMENT,
						product_name VARCHAR(50),
						product_price INT,
						PRIMARY KEY (product_id)) ENGINE=INNODB;";
					//Table Customer
				$sql .= "CREATE TABLE IF NOT EXISTS CUSTOMER
						(customer_id INT NOT NULL AUTO_INCREMENT,
						customer_name VARCHAR(50),
						customer_surname VARCHAR(50),
						PRIMARY KEY (customer_id)) ENGINE=INNODB;";
					//Table Salesman
				$sql .= "CREATE TABLE IF NOT EXISTS SALESMAN
						(salesman_id INT NOT NULL AUTO_INCREMENT,
						salesman_name VARCHAR(50),
						salesman_surname VARCHAR(50),
						market_id INT NOT NULL,
						PRIMARY KEY (salesman_id),
						FOREIGN KEY (market_id) REFERENCES MARKET(market_id) ON UPDATE CASCADE ON DELETE CASCADE) ENGINE=INNODB;";
					//Table Sales
				$sql .= "CREATE TABLE IF NOT EXISTS SALES
						(sales_id INT NOT NULL AUTO_INCREMENT,
						customer_id INT NOT NULL,
						salesman_id INT NOT NULL,
						product_id INT NOT NULL,
						sale_date DATE,
						PRIMARY KEY (sales_id),
						FOREIGN KEY (customer_id) REFERENCES CUSTOMER(customer_id) ON UPDATE CASCADE ON DELETE CASCADE,
						FOREIGN KEY (salesman_id) REFERENCES SALESMAN(salesman_id) ON UPDATE CASCADE ON DELETE CASCADE,
						FOREIGN KEY (product_id) REFERENCES PRODUCT(product_id)) ENGINE=INNODB;";
				
				//All Table Sql query send to database
				if ($conn->multi_query($sql) === TRUE) {
    				echo "Tables(DISTRICT,CITY,MARKET,CUSTOMER,SALESMAN,PRODUCT,SALES) created.<br>";
				} else {
    				echo "Error: " . $sql . "<br>" . $conn->error;
    				$conn->close();
    				return ;
				}

////////////////////////////////////////////////////////////////////////////////
				//multi-result'ı boşaltmak için baglantı yenileniyor
				$conn->close();


				// Create connection
				$conn = new mysqli($servername,$username,$password,$database);
				// Check connection
				if ($conn->connect_error) {
    				die("Connection failed: ".$conn->connect_error);
				}
////////////////////////////////////////////////////////////////////////////////
				//TABLOLAR BURDA DOLUYOR


				$i=0;
				ini_set('memory_limit','18M'); // Php memmory ile ilgili kucuk bir ayar
				


				//District tablosu doluyor
				$a_districts=getcsvfile("Datas/Districts.csv",2);

				$data[0]=$a_districts[0][$i];
				$data[1]=$a_districts[1][$i];
				$sql ="INSERT INTO DISTRICT (district_id,district_name)
						VALUES ('$data[0]','$data[1]');";
				$i++;
				
				while ($i<sizeOf($a_districts[0])) {
					$data[0]=$a_districts[0][$i];
					$data[1]=$a_districts[1][$i];
					$sql .="INSERT INTO DISTRICT (district_id,district_name)
						VALUES ('$data[0]','$data[1]');";
					$i++;

				}
				
				
				if ($conn->multi_query($sql) === TRUE) {
    				echo "Table DISTRICT filled.<br>"; //District tablosu başarılı bir sekilde doldu.
				} else {
    				echo "Error: " . $sql . "<br>" . $conn->error;
    				$conn->close();
    				return ;
				}
         
////////////////////////////////////////////////////////////////////////////////
				//multi-result'ı boşaltmak için baglantı yenileniyor
				$conn->close();


				// Create connection
				$conn = new mysqli($servername,$username,$password,$database);
				// Check connection
				if ($conn->connect_error) {
    				die("Connection failed: ".$conn->connect_error);
				}
////////////////////////////////////////////////////////////////////////////////
				$i=0;


				//City tablosu doluyor

				$a_cities=getcsvfile("Datas/Cities.csv",2);

				$data[0]=$a_cities[0][$i];
				$data[1]=$a_cities[1][$i];
				$sql ="INSERT INTO CITY (city_name,district_id)
						VALUES ('$data[0]','$data[1]');";
				$i++;
				
				while ($i<sizeOf($a_cities[0])) {
					$data[0]=$a_cities[0][$i];
					$data[1]=$a_cities[1][$i];
					$sql .="INSERT INTO CITY (city_name,district_id)
						VALUES ('$data[0]','$data[1]');";
					$i++;

				}
				
				
				if ($conn->multi_query($sql) === TRUE) {
    				echo "Table CITY filled.<br>";  //city tablosu basarılı bir sekilde doldu
				} else {
    				echo "Error: " . $sql . "<br>" . $conn->error;
    				$conn->close();
    				return ;
				}

////////////////////////////////////////////////////////////////////////////////
				//multi-result'ı boşaltmak için baglantı yenileniyor
				$conn->close();


				// Create connection
				$conn = new mysqli($servername,$username,$password,$database);
				// Check connection
				if ($conn->connect_error) {
    				die("Connection failed: ".$conn->connect_error);
				}
////////////////////////////////////////////////////////////////////////////////
				$i=0;
				$control;

				//Market doluyor Her Şehirde random 5 tane market atıcak 10 market icerisinden
				$sql ="";


				$a_markets=getcsvfile("Datas/Markets.csv",1);

				for($i=1;$i<=81;$i++){
					$control[0]=rand(0, 9);
					$control[1]=($control[0]+1)%10;
					$control[2]=($control[1]+1)%10;
					$control[3]=($control[2]+1)%10;
					$control[4]=($control[3]+1)%10;





					$data[0]=$a_markets[0][$control[0]];
					$data[1]=$i;
					$sql .="INSERT INTO MARKET (market_name,city_id)
						VALUES ('$data[0]','$data[1]');";
					$data[0]=$a_markets[0][$control[1]];
					$data[1]=$i;

					$sql .="INSERT INTO MARKET (market_name,city_id)
						VALUES ('$data[0]','$data[1]');";
					$data[0]=$a_markets[0][$control[2]];
					$data[1]=$i;

					$sql .="INSERT INTO MARKET (market_name,city_id)
						VALUES ('$data[0]','$data[1]');";
					$data[0]=$a_markets[0][$control[3]];
					$data[1]=$i;

					$sql .="INSERT INTO MARKET (market_name,city_id)
						VALUES ('$data[0]','$data[1]');";
					$data[0]=$a_markets[0][$control[4]];
					$data[1]=$i;

					$sql .="INSERT INTO MARKET (market_name,city_id)
						VALUES ('$data[0]','$data[1]');";

				}
				if ($result=$conn->multi_query($sql) === TRUE) {
    				echo "Table MARKET filled.<br>"; //Market tablosu basarılı bir sekilde doldu
				} else {
    				echo "Error: " . $sql . "<br>" . $conn->error;
    				$conn->close();
    				return ;
				}

////////////////////////////////////////////////////////////////////////////////
				//multi-result'ı boşaltmak için baglantı yenileniyor
				$conn->close();


				// Create connection
				$conn = new mysqli($servername,$username,$password,$database);
				// Check connection
				if ($conn->connect_error) {
    				die("Connection failed: ".$conn->connect_error);
				}
////////////////////////////////////////////////////////////////////////////////
				$i=0;
				

				//Customer table doluyor 500 random isim x 500 random soyisim 

				$sql ="";

				$a_name=getcsvfile("Datas/isimler.csv",1);
				$a_surname=getcsvfile("Datas/soyisimler.csv",1);

				for(;$i<1620;$i++){
					$control[0]=rand(0, 500);
					$control[1]=rand(0, 500);
					$data[0]=$a_name[0][$control[0]];
					$data[1]=$a_surname[0][$control[0]];
					$sql .="INSERT INTO CUSTOMER (customer_name,customer_surname)
						VALUES ('$data[0]','$data[1]');";
				}

				if ($result=$conn->multi_query($sql) === TRUE) {
    				echo "Table CUSTOMER filled.<br>"; //customer tablosu doldu
				} else {
    				echo "Error: " . $sql . "<br>" . $conn->error;
    				$conn->close();
    				return ;
				}

////////////////////////////////////////////////////////////////////////////////
				//multi-result'ı boşaltmak için baglantı yenileniyor
				$conn->close();


				// Create connection
				$conn = new mysqli($servername,$username,$password,$database);
				// Check connection
				if ($conn->connect_error) {
    				die("Connection failed: ".$conn->connect_error);
				}
////////////////////////////////////////////////////////////////////////////////
				
				$control[2]=0;
				//Salesman table doluyor her market de 3 tane salesman yerlestiriliyor

				$sql ="";

				for($i=0;$i<1215;$i++){
					$control[0]=rand(0, 500);
					$control[1]=rand(0, 500);
					$data[0]=$a_name[0][$control[0]];
					$data[1]=$a_surname[0][$control[0]];
					if(0==$i%3){
						$control[2]++;
						$data[2]=$control[2];
						
					}
					$sql .="INSERT INTO SALESMAN (salesman_name,salesman_surname,market_id)
						VALUES ('$data[0]','$data[1]','$data[2]');";
				}

				if ($result=$conn->multi_query($sql) === TRUE) {
    				echo "Table SALESMAN filled.<br>"; //salesman tablosu doldu
				} else {
    				echo "Error: " . $sql . "<br>" . $conn->error;
    				$conn->close();
    				return ;
				}

////////////////////////////////////////////////////////////////////////////////
				//multi-result'ı boşaltmak için baglantı yenileniyor
				$conn->close();


				// Create connection
				$conn = new mysqli($servername,$username,$password,$database);
				// Check connection
				if ($conn->connect_error) {
    				die("Connection failed: ".$conn->connect_error);
				}
////////////////////////////////////////////////////////////////////////////////
				

				//Product table doluyor 
				$a_urunler=getcsvfile("Datas/Products.csv",1);

				$sql ="";
				for($i=0;$i<200;$i++){
					$data[0]=$a_urunler[0][$i];
					$data[1]=rand(1, 50);
					$sql .="INSERT INTO PRODUCT (product_name,product_price)
						VALUES ('$data[0]','$data[1]');";
				}


				if ($conn->multi_query($sql) === TRUE) {
    				echo "Table PRODUCT filled.<br>"; //product tablosu basarı ile doldu
				} else {
    				echo "Error: " . $sql . "<br>" . $conn->error;
    				$conn->close();
    				return ;
				}


////////////////////////////////////////////////////////////////////////////////
				//multi-result'ı boşaltmak için baglantı yenileniyor
				$conn->close();


				// Create connection
				$conn = new mysqli($servername,$username,$password,$database);
				// Check connection
				if ($conn->connect_error) {
    				die("Connection failed: ".$conn->connect_error);
				}
////////////////////////////////////////////////////////////////////////////////
				
				//sales table icin kucuk bi on ayar

				$i=1;
				$control[0]=0;
				$control[1]=0;
				$control[2]=0;
				$control[3]=1;
				$control[4]=1;
				$control[5]=1;

				//Sales table doluyor

				$sql ="SET FOREIGN_KEY_CHECKS=0;"; //foreing key controlu kapatılıyor

				for(;$i<=1620;$i++){

					$control[0]=rand(1, 5);
					while ($control[0]>0) {

						$control[1]=rand(1, 1215);//salesman
						$data[0]=$control[1];
						$control[2]=rand(1, 200);//product
						$data[1]=$control[2];
						$control[3]=rand(1,28);//gun  /// 28 gun ustu be subat ayı ise 0000-00-00 oluyor
						$control[4]=rand(1,12);//ay
						$control[5]=rand(1989,2016);
						$data[2]=$control[5].'-'.$control[4].'-'.$control[3];
						$sql .="INSERT INTO SALES(customer_id,salesman_id,product_id,sale_date)
						VALUES ('$i','$data[0]','$data[1]','$data[2]');";
						$control[0]--;
					}
					

				}
				$sql .="SET FOREIGN_KEY_CHECKS=1;"; //foreing key controlu acılıyor
				
				if ($conn->multi_query($sql) === TRUE) {
    				echo "Table SALES filled.<br>";  //table sale basırı lı bir sekilde doldu
				} else {
    				echo "Error: " . $sql . "<br>" . $conn->error;
    				$conn->close();
    				return ;
				}

////////////////////////////////////////////////////////////////////////////*********************

				echo " All Tables filled.";


				$conn->close();//baglantı kapatıldı
				
				
			}
			FUNCTION getcsvfile($filename,$length){ //csv dosyalarını okumak icin yazılmıs minik bi fonksiyonum.
				$array;
   				$index = 0;
				$file = fopen($filename,"r");
				while($index<$length){
  		
  					$array[$index]=fgetcsv($file,0,';');
  					$index++;
  				}
				fclose($file);
				return $array;
				
			}

	?>

</head>
<body>

<p>
	Name : Gokhan Gobus<br>
Id : 280702020<br>
Lesson : CSE 348 Section 1<br>
E-Mail : gokhangobus@hotmail.com , gokhangobus@gmail.com ,gokhan.gobus@std.yeditepe.edu.tr<br>
Description : Database Management Systems Project<br>
				install php<br>
1)gokhan_gobus database'i olusturuluyor<br>
2)gerekli tablolar databasede yaratiliyor<br>
3)yaratilan tablolar gerekli bilgiler ile dolduruluyor<br>
</p>

<hr><?php str_repeat('&nbsp;', 30);?>

<form method="post" action="install.php">
<input type="submit" value="Install" name="submit" style="width:100px; height:100px;"> 
</form>

<?php                                   ///kendi kendine yolluyor isset kendini yakalar ise instal ediyor  
if(isset($_POST['submit']))
{
   createdatabase();
   createandfilltables();

}
?>


	

</body>
</html>