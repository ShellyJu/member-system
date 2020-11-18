<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="js/jquery-2.1.0.min.js"></script>
	<title>Document</title>
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
			 	location.href = "login.php";
			 }
		});

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
	<h1>地圖</h1>
</body>
</html>