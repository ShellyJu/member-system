<?php
	$p_id = $_POST["id"];
	$p_username = $_POST["username"];
	$p_password = $_POST["password"];
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

		$sql = "UPDATE member SET Username = '$p_username', Password = '$p_password', Email = '$p_email' WHERE id= '$p_id'";

		if(mysqli_query($link, $sql)){
			echo '{"state" : true, "message" : "更新成功"}';
		}else{
			echo '{"state" : false, "message" : "更新失敗"}';
		}

		mysqli_close($link);
	}else{
		echo '{"state" : false, "message" : "更新失敗, 欄位不得為空白值!"}';
	}


?>