<?php

$host='localhost';
$user='root';
$pass='';
$db='mydb';
$Entered_name=$_POST["Name"];
$Entered_birthday=$_POST["birthday"];
$Entered_RollNo=$_POST["RollNo"];

try {
       $fTime = new DateTime($Entered_birthday);
       //$fTime->format('m/d/Y H:i:s');
	   $fTime->format('m/d/Y');
        echo "date correct";
		$con=mysqli_connect($host,$user,$pass,$db);
		$sql="INSERT INTO BDAY VALUES ('$Entered_name','$Entered_RollNo',STR_TO_DATE('$Entered_birthday','%m/%d/%Y'))";
		$query=mysqli_query($con,$sql);
		if ($query) 
		{
		echo "$Entered_name,Birthday Added";
		header("Location: index.php");
		}
		
    }
    catch (Exception $e) {
        echo "date incorrect";
    }
?>
