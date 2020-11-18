<?php
	$servername = "localhost";
	$username ="root";
	$passowrd = "";
	$dbname = "userdb";

	$link = mysqli_connect($servername, $username, $passowrd, $dbname );

	if(!$link){
		die("連線錯誤".mysql_connect_error());
	}

	$sql = "SELECT * FROM member ORDER BY ID DESC";

	$result = mysqli_query($link, $sql);

	$mydata = array();

	while($row = mysqli_fetch_assoc($result)){
		$mydata[] = $row;
	}

	echo json_encode($mydata);
	
	mysqli_close($link);
?>