<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Document</title>
	<link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css">
	<script src="js/jquery-2.1.0.min.js"></script>
	<script src="js/jquery.mobile-1.4.5.min.js"></script>
	<script>
		$(function(){
			//先判斷uid是否存在或者uid是否正確
			 $cookie_uid = getCookie("uid");

			 if($cookie_uid != ""){
			 	$.ajax({
			 		type: "POST",
			 		url: "api/check_uid_api.php",
			 		data: {uid: $cookie_uid},
			 		dataType: "json",
			 		success: showdata_check_uid,
			 		error: function(){
			 			alert("error api/check_uid_api.php");
			 		}
			 	});
			 }else{
			 	alert("未登入會員, 請先登入會員!!");
			 }


			$("#login_ok_btn").bind("click", function(){
				$.ajax({
					type: "POST",
					url: "api/login_api.php",
					data: {username: $("#username").val(), password: $("#password").val()},
					dataType: "json",
					success: showdata_login,
					error: function(){
						alert("error api/login_api.php");
					}
				});
			});
		});
		function showdata_login(data){
			if(data.state){
				alert(data.message);
				setCookie("uid", data.uid, 7);
				location.href = "main.php";
			}else{
				alert(data.message);
			}
		}

		function showdata_check_uid(data){
			console.log(data);
			if(data.state){
				alert("已登入!");
				location.href = "main.php";
			}else{
				alert("未登入!");
			}
		}

//*********************************************************
		function setCookie(cname, cvalue, exdays) {
		  var d = new Date();
		  d.setTime(d.getTime() + (exdays*24*60*60*1000));
		  var expires = "expires="+ d.toUTCString();
		  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}	

		function getCookie(cname) {
		  var name = cname + "=";
		  var decodedCookie = decodeURIComponent(document.cookie);
		  var ca = decodedCookie.split(';');
		  for(var i = 0; i <ca.length; i++) {
		    var c = ca[i];
		    while (c.charAt(0) == ' ') {
		      c = c.substring(1);
		    }
		    if (c.indexOf(name) == 0) {
		      return c.substring(name.length, c.length);
		    }
		  }
		  return "";
		}	

	</script>
</head>
<body>
	<div data-role="page" id="home">
		<div data-role="header" data-theme="b">
			<h1>會員登入</h1>
		</div>
		<div role="main" class="ui-content">
			<div data-role="fieldcontain">
				<label for="username">帳號</label>
				<input type="text" name="username" id="username" value="">
			</div>
			<div data-role="fieldcontain">
				<label for="password">密碼</label>
				<input type="password" name="password" id="password" value="">
			</div>
			<div class="ui-grid-a">
				<div class="ui-block-a">
					<a href="#" data-role="button" data-theme="b" data-icon="check">取消</a>
				</div>
				<div class="ui-block-b">
					<a href="#" data-role="button" data-theme="b" data-icon="check" id="login_ok_btn">登入</a>
				</div>
			</div>
		</div>
		<div data-role="footer" data-theme="b" data-position="fixed">
			<h1>頁尾</h1>
		</div>
	</div>
</body>
</html>