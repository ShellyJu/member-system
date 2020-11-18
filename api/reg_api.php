<?php

	$p_username = $_POST["username"];
	$p_password = md5($_POST["password"]);
	$p_email = $_POST["email"];

	if($p_username != "" && $p_password != "" && $p_email != ""){
		$servername = "localhost";
		$username ="root";
		$passowrd = "";
		$dbname = "userdb";

		$link = mysqli_connect($servername, $username, $passowrd, $dbname );

		if(!$link){
			die("連線錯誤".mysql_connect_error());
		}

		$sql = "INSERT INTO member (Username, Password, Email) VALUES ('$p_username', '$p_password', '$p_email')";
		if(mysqli_query($link, $sql)){
			echo '{"state" : true, "message" : "註冊成功"}';
		}else{
			echo '{"state" : false, "message" : "註冊失敗"}';
		}

		mysqli_close($link);		
	}else{
		echo '{"state" : false, "message" : "註冊失敗, 欄位不得為空白值!"}';
	}

?>
