<?php
	$p_username = $_POST["username"];

	if( $p_username != "" ){
		$servername = "localhost";
		$username ="root";
		$passowrd = "";
		$dbname = "userdb";

		$link = mysqli_connect($servername, $username, $passowrd, $dbname );

		if(!$link){
			die("連線錯誤".mysql_connect_error());
		}

		$sql = "SELECT * FROM member WHERE Username = '$p_username'";

		$result = mysqli_query($link, $sql);

		if(mysqli_num_rows($result) == 1){
			echo '{"state" : false, "message" : "帳號已存在,不可使用!"}';
		}else{
			echo '{"state" : true, "message" : "帳號可使用!"}';
		}
	}else{
		echo '{"state" : false, "message" : "欄位不得為空白!"}';
	}



?>