<?php
	$p_uid = $_POST["uid"];
	if($p_uid != ""){	
		$servername = "localhost";
		$username ="root";
		$passowrd = "";
		$dbname = "userdb";

		$link = mysqli_connect($servername, $username, $passowrd, $dbname );

		if(!$link){
			die("連線錯誤".mysql_connect_error());
		}

		$sql = "SELECT * FROM member WHERE Uid = '$p_uid'";	

		$result = mysqli_query($link, $sql);

		if(mysqli_num_rows($result) == 1){
				echo '{"state" : true, "message" : "uid認證成功"}';
		}else{
				echo '{"state" : false, "message" : "uid認證失敗"}';
		}
		mysqli_close($link); 
	}else{
		echo '{"state" : false, "message" : "uid不得為空值!"}';
	}
?>