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
		var flag_username = false;

		$(function(){
			$("#username").bind("input propertychange", function(){
				if($(this).val().length >= 8){

					$("#err_username").html("");
					flag_username = true;

					$.ajax({
						type: "POST",
						url: "api/check_uni_api.php",
						data: {username: $(this).val()},
						dataType: "json",
						success: showdata_check_uni,
						error: function(){
							alert("error api/check_uni_api.php");
						}
					});
				}else{
					$("#err_username").html("帳號不得少於8個字數!");
					$("#err_username").css("color", "red");
					flag_username = false;
				}
			});

			$("#reg_ok_btn").bind("click", function(){
				if(flag_username){
					$.ajax({
						type: "POST",
						url: "api/reg_api.php",
						dataType: "json",
						data: {username: $("#username").val(), password: $("#password").val(), email: $("#email").val()},
						success: showdata,
						error: function(){
							alert("error api/reg_api.php")
						}
					});
				}else{
					alert("帳號不符合規定或者帳號已存在");
				}
			});
		});

		function showdata(data){
			console.log(data);
			if(data.state){
				alert(data.message);
				location.href = "login.php";
			}else{
				alert(data.message);
			}
		}

		function showdata_check_uni(data){
			console.log(data);
			if(data.state){
				//帳號可以使用
				$("#err_username").html(data.message);
				$("#err_username").css("color", "green");
				flag_username = true;
			}else{
				//帳號不可以使用
				$("#err_username").html(data.message);
				$("#err_username").css("color", "red");
				flag_username = false;
			}
		}
	</script>
</head>
<body>
	<div data-role="page" id="home">
		<div data-role="header" data-theme="b">
			<h1>會員註冊</h1>
		</div>
		<div role="main" class="ui-content">
			<div data-role="fieldcontain">
				<label for="username">帳號</label>
				<input type="text" name="username" id="username" value="">
			</div>
			<div id="err_username"></div>

			<div data-role="fieldcontain">
				<label for="password">密碼</label>
				<input type="password" name="password" id="password" value="">
			</div>
			<div data-role="fieldcontain">
				<label for="email">Email</label>
				<input type="email" name="email" id="email" value="">
			</div>
			<div class="ui-grid-a">
				<div class="ui-block-a">
					<a href="#" data-role="button" data-theme="b" data-icon="check">取消</a>
				</div>
				<div class="ui-block-b">
					<a href="#" data-role="button" data-theme="b" data-icon="check" id="reg_ok_btn">註冊</a>
				</div>
			</div>
		</div>
		<div data-role="footer" data-theme="b" data-position="fixed">
			<h1>頁尾</h1>
		</div>
	</div>
</body>
</html>