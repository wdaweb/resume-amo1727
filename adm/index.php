<?php 
include_once '../include/_common.php';
$_SESSION["vcode"]="";
if (!empty($_GET['logout'])) {
  if ($_GET['logout'] == '1') {
    unset($_SESSION['userpk']);
    fun_alertmsg ("已登出系統!!","index.php");
    exit();
  } 
}
if (!empty($_SESSION["userpk"])) {
  header("location: manage.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>個人履歷系統</title>
	<link href="css/login.css" rel="stylesheet" />
	<script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>
</head>
<body>
	<div class="loginbox">
		<div class="search"> 
			<form name="signin" method="post" action="login_api.php" >
				<div style="float:right;">[ <a href="../" >回前台</a> ]</div>
				<div class="clear"></div>
				<h2>個人履歷系統</h2>
				<label>
					<input type="text" class="form-control" value="1727" id="acc" name="acc" />
					<span>請輸入帳號</span>
				</label>
				<label>
					<input type="password" class="form-control" value="1727" id="pw" name="pw" />
					<span>請輸入密碼</span>
				</label>
				
				<div style="width:40%;float:left;">
					<label>
						<input type="text" class="form-control" value="" id="vcode" name="vcode"/>
						<span>請輸入驗證碼</span>
					</label>
				</div>
				<div style="width:60%;float:right;padding: 13px 0 0 0;">
				<img src="vcodepic.php" id="codeP"> <a href="javascript:void(0);" onClick="return rfvcode();"><img src="./images/refresh.png" width="30px" height="30px" id="refresh" ></a>
				</div>
				<div class="clear"></div>
				
				<input type="hidden" name="sub_login" value="1">
				<button name="s1" type="submit" class="btn btn-primary btn-lg">
					<span class="glyphicon"></span> 登 入
				</button>
			</form> 
		</div>
	</div>
<script>
$(function () {
	$('input').on('focus', function () {
		$(this).parent().addClass('active');
	});
	$('input').on('blur', function () {
		if ($(this).val() === "") {
			$(this).parent().removeClass('active');
		}
	});
	
});
function rfvcode() {
     document.getElementById("codeP").src = "vcodepic.php?tm=" + Math.random();
}
</script>
</body>
</html>