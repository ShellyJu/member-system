<?php
		$p_id = $_POST["id"];

		if($p_id != ""){
			$servername = "localhost";
			$username ="root";
			$passowrd = "";
			$dbname = "userdb";

			$link = mysqli_connect($servername, $username, $passowrd, $dbname );

			if(!$link){
				die("連線錯誤".mysql_connect_error());
			}
			$sql = "DELETE FROM member WHERE id = '$p_id'";

			if(mysqli_query($link, $sql) && mysqli_affected_rows($link) == 1){
				echo '{"state" : true, "message" : "刪除成功"}';
			}else{
				echo '{"state" : false, "message" : "刪除失敗"}';
			}

			mysqli_close($link);			
		}else{
			echo '{"state" : false, "message" : "刪除失敗, 參數不得空白!"}';
		}	


?>