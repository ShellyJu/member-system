<?php
	
	$p_username = $_POST["username"];
	$p_password = md5($_POST["password"]);
	if($p_username != "" && $p_password != ""){
		$servername = "localhost";
		$username ="root";
		$passowrd = "";
		$dbname = "userdb";

		$link = mysqli_connect($servername, $username, $passowrd, $dbname );

		if(!$link){
			die("連線錯誤".mysql_connect_error());
		}

		$sql = "SELECT * FROM member WHERE Username = '$p_username' and Password = '$p_password '";	

		$result = mysqli_query($link, $sql);

		if(mysqli_num_rows($result) == 1){
			//更新Uid
			$uid_string = md5(uniqid());

			$sql = "UPDATE member SET Uid = '$uid_string' WHERE Username= '$p_username'";

			mysqli_query($link, $sql);

			echo '{"state" : true, "message" : "登入成功", "uid" : "'.$uid_string.'"}';
		}else{
			echo '{"state" : false, "message" : "登入失敗"}';
		}

		mysqli_close($link);		
	}else{
		echo '{"state" : false, "message" : "登入失敗,帳號或密碼不得為空白值!"}';
	}

?>