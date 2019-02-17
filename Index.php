<html>
<HEADER>
<CENTER><font color="red" face="verdana"><h1>BIRTHDAY CELEBRATION LIST</h1></font></CENTER>

</HEADER>
<body style='background-color:LightBlue'>
<CENTER>
<br><br>
<form action="validated.php" method="post">
<font color="blue" face="verdana"><h4> Add Birthday date</h4><br>
Enter Name: <input type="text" name="Name" required>  RollNo: <input type="text" name="RollNo" required>  Brithday date (MM/DD/YYYY) :<input type="text" name="birthday" value="<?php echo date('m/d/Y');?>" required>
</font>
<input type="submit">
</form>

<font color="blue" face="verdana">
<?php

$host='localhost';
$user='root';
$pass='';
$db='mydb';


$con=mysqli_connect($host,$user,$pass,$db);
		$sql="SELECT NAME,RollNo,birthday from 
(select NAME,RollNo,STR_TO_DATE(concat(substr(cast(Birthday as char),6),'-',year(CURDATE())),'%m-%d-%Y') as birthday from bday) AS A
WHERE birthday > CURRENT_DATE AND birthday < CURRENT_DATE + INTERVAL 100 DAY
UNION
SELECT NAME,RollNo,birthday from 
(select NAME,RollNo,STR_TO_DATE(concat(substr(cast(Birthday as char),6),'-',year(CURDATE())+1),'%m-%d-%Y') as birthday from bday) AS A
WHERE birthday > CURRENT_DATE AND birthday < CURRENT_DATE + INTERVAL 100 DAY
ORDER BY birthday ASC;";
		$result=mysqli_query($con,$sql);
		if ($result) 
			echo "<h4>Upcomming birthday List</h4><br><br>";

if(mysqli_num_rows($result) > 0 ){
	 while($row=mysqli_fetch_array($result))
 {
	 $db_name=$row["NAME"];
	 $db_RollNo=$row["RollNo"];
	 $db_Birthday=$row["birthday"];
	 echo "<Marquee> $db_name($db_RollNo) is celebrating his birthday on $db_Birthday</Marquee><br><br>";
 }
} 
    else{
		echo "No upcommimg birthdays";
	exit();
	}

		
		
?>
</CENTER>
</font>
</body>
</html>
