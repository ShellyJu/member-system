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
			 	alert("未登入會員!");
			 	location.href = "login.php";
			 }

			$.ajax({
				type: "GET",
				url: "api/mem_list_api.php",
				async: false,
				dataType: "json",
				success: showdata_list,
				error: function(){
					alert("error api/mem_list_api.php");
				}
			});

			//監聽 table 更新按鈕
			$("#tbody_list #updata_btn").bind("click", function(){
				//Adding the changeHash: false to avoid an issue with the iframe
				$.mobile.changePage( "#update", { transition: "slideup", changeHash: false });
				console.log($(this).data("id"));
				console.log($(this).data("username"));
				console.log($(this).data("password"));
				console.log($(this).data("email"));

				$("#id").val($(this).data("id"));
				$("#username").val($(this).data("username"));
				$("#password").val($(this).data("password"));
				$("#email").val($(this).data("email"));
			});

			//監聽 table 刪除按鈕
			$("#tbody_list #delete_btn").bind("click", function(){
				if(confirm("確認要刪除編號為" +  $(this).data("id") +"的使用者嗎?")){
					$.ajax({
						type: "POST",
						url: "api/del_api.php",
						data: {id: $(this).data("id")},
						dataType: "json",
						success: showdata_del,
						error: function(){
							alert("error api/del_api.php");
						}
					});					
				}
			})

			$("#update_ok_btn").bind("click", function(){
				$.ajax({
					type: "POST",
					url: "api/update_api.php",
					data: {id: $("#id").val(), username: $("#username").val(), password: $("#password").val(), email: $("#email").val()},
					dataType: "json",
					success: showdata_updata,
					error: function(){
						alert("error api/update_api.php");
					}
				});
			});
			



		});

		function showdata_list(data){
			console.log(data);
			for(var i=0; i<data.length; i++){
				var strHTML = '<tr><td>'+data[i]["ID"]+'</td><td>'+data[i]["Username"]+'</td><td>'+data[i]["Password"]+'</td><td>'+data[i]["Email"]+'</td><td>'+data[i]["Created_at"]+'</td><td><button id="updata_btn" data-id="'+data[i]["ID"]+'" data-username="'+data[i]["Username"]+'" data-password="'+data[i]["Password"]+'" data-email="'+data[i]["Email"]+'">更新</button><button id="delete_btn" data-id="'+data[i]["ID"]+'">刪除</button></td></tr>';
				$("#tbody_list").append(strHTML);
			}
		}

		function showdata_updata(data){
			console.log(data);
			if(data.state){
				alert(data.message);
				location.href = "main.php";
			}else{
				alert(data.message);
			}
		}

		function showdata_del(data){
			console.log(data);
			if(data.state){
				alert(data.message);
				location.href = "main.php";
			}else{
				alert(data.message);
			}
		}

		function showdata_check_uid(data){
			console.log(data);
			if(data.state){
				alert("已登入!");
			}else{
				alert("未登入!");
				location.href = "login.php";
			}
		}








//***************引用至w3school********************************
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
	<!-- 控制台主畫面 -->
	<div data-role="page" id="home">
		<div data-role="header" data-theme="b">
			<h1>控制台主畫面</h1>
		</div>
		<div role="main" class="ui-content">
			<table data-role="table" id="movie-table" data-mode="reflow" class="ui-responsive">
				<thead>
					<tr>
						<th>編號</th>
						<th>帳號</th>
						<th>密碼</th>
						<th>Email</th>
						<th>註冊時間</th>
						<th>#####</th>
					</tr>
				</thead>
				<tbody id="tbody_list">
				</tbody>
			</table>			
		</div>
	</div>

	<!-- 會員更新 -->
	<div data-role="page" id="update">
		<div data-role="header" data-theme="b">
			<h1>會員更新</h1>
		</div>
		<div role="main" class="ui-content">
			<div data-role="fieldcontain">
				<label for="id">ID</label>
				<input type="number" name="id" id="id" value="" disabled>
			</div>
			<div data-role="fieldcontain">
				<label for="username">帳號</label>
				<input type="text" name="username" id="username" value="">
			</div>
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
					<a href="#" data-role="button" data-theme="b" data-icon="check" id="update_ok_btn">更新</a>
				</div>
			</div>
		</div>
		<div data-role="footer" data-theme="b" data-position="fixed">
			<h1>頁尾</h1>
		</div>
	</div>
</body>
</html>