<?php

$mydb = mysql_connect("localhost", "alanmand_user1", "daBrav3s") or die(mysql_error());
mysql_select_db("alanmand_baby") or die(mysql_error());

$mode = $_GET["mode"];
if ($mode=="newEvent"){
	$eventID = $_GET["eventID"];
	$userID = $_GET["UserID"];
	$start = date("Y-m-d H:i:s", time());
	$sql="INSERT INTO Log (EventID,UserID,Start) VALUES ($eventID,$userID,'$start')";
	#echo $sql;
	$result = mysql_query($sql);
	header("Location: http://alanmanderson.com/Baby/index.php");
} elseif ($mode=="stopEvent"){
	$eventID = $_GET["eventID"];
	$userID = $_GET["userID"];
	$start = $_GET["start"];
	$end = date("Y-m-d H:i:s", time()); 
	$sql="UPDATE Log SET End='$end' WHERE End='0000-00-00 00:00:00' AND EventID=$eventID";
	#echo $sql;
	$result = mysql_query($sql);
	header("Location: http://alanmanderson.com/Baby/index.php");
}

?>