<?php
include_once '../include/_common.php';
if (empty($_SESSION['userpk'])) {
	fun_alertmsg ('尚未登入或閒置時間過長，請重新登入!!','index.php');
	exit;
}
include './include/_resume.php';
// ini_set("memory_limit","2048M");

$base_cname="";
$base_ename="";
$base_gender="";
$base_marital="";
$base_birthday="";
$base_email="";
$base_call_phone="";
$base_call_time="";
$base_address="";
$base_pic_name="";
$base_pic_type="";
$base_pic_show="";
if (!empty($resume_pk)) {
	$result=fun_findDB_basedata($_SESSION['userpk'],$resume_pk);
	if ($result) {
		$base_pk=$result["pk"];
		$base_cname=$result["cname"];
		$base_ename=$result["ename"];
		$base_gender=$result["gender"];
		$base_marital=$result["marital"];
		$base_birthday=$result["birthday"];
		$base_email=$result["email"];
		$base_call_phone=$result["call_phone"];
		$base_call_time=$result["call_time"];
		$base_address=$result["address"];
		$base_pic_name=$result["pic_name"];
		$base_pic_type=$result["pic_type"];
		$base_pic_show=$result["pic_show"];
	}
}
$selstr_gender_2 = "";
$selstr_gender_1 = "";
if ($base_gender == 1) {
	$selstr_gender_1 = "selected";
} else if ($base_gender == 2) {
	$selstr_gender_2 = "selected";
}

$selstr_marital_1 = "";
$selstr_marital_2 = "";
$selstr_marital_3 = "";
if ($base_marital == 1) {
	$selstr_marital_1 = "selected";
} else if ($base_marital == 2) {
	$selstr_marital_2 = "selected";
} else if ($base_marital == 3) {
	$selstr_marital_3 = "selected";
}

// echo date("Y",strtotime($base_birthday));
// exit();

$selstr_birthdayYear = "";
$selstr_birthdayMonth = "";
$selstr_birthdayDate = "";
$now_year=(int)date("Y");
for ($i=($now_year-17); $i > ($now_year-85); $i--) { 
	$selstr_birthdayYearsel = "";
	if (!empty($base_birthday)) {
		if ((int)date("Y",strtotime($base_birthday)) == $i) {
			$selstr_birthdayYearsel = "selected";
		}	
	}
	$selstr_birthdayYear .= '<option value="'. $i .'" '. $selstr_birthdayYearsel .'>'. $i .'</option>';
}
for ($i=1; $i <= 12 ; $i++) { 
	$selstr_birthdayMonthsel = "";
	if (!empty($base_birthday)) {
		if ((int)date("n",strtotime($base_birthday)) == $i) {
			$selstr_birthdayMonthsel = "selected";
		}	
	}
	$selstr_birthdayMonth .= '<option value="'. sprintf("%02d",$i) .'" '. $selstr_birthdayMonthsel .'>'. sprintf("%02d",$i) .'</option>';
}
for ($i=1; $i <= 31 ; $i++) { 
	$selstr_birthdayDatesel = "";
	if (!empty($base_birthday)) {
		if ((int)date("j",strtotime($base_birthday)) == $i) {
			$selstr_birthdayDatesel = "selected";
		}	
	}
	$selstr_birthdayDate .= '<option value="'. sprintf("%02d",$i) .'" '. $selstr_birthdayDatesel .'>'. sprintf("%02d",$i) .'</option>';
}

$selstr_pic="";
if ($base_pic_name != "") {
	if ($base_pic_show == 1) {
		$selstr_pic = '<input type="checkbox" name="pic_show" id="pic_show" value="1" checked><label for="pic_show">顯示</label><br>';
	} else {
		$selstr_pic = '<input type="checkbox" name="pic_show" id="pic_show" value="1"><label for="pic_show">顯示</label><br>';
	}
	$selstr_pic .= '<img src="../img/basedata/'.$_SESSION['userpk'].'_'.$base_pic_name.'_a.'.$base_pic_type.'"><br><br>';
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>個人履歷系統</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="./css/style.css" />
</head>
<body class="is-preload">
	<div id="page-wrapper">
		<?php include './include/_header.php';?>
		<article id="main">
			<section class="wrapper style5">
				<section class="inner">
					<h2>基本資料</h2>
<!-- *********************************************************** -->
					<section>
						<form class="formEdit" enctype="multipart/form-data" action="basedata_api.php" method="post" id="basedataForm" >
							<div class="row gtr-uniform">	                    
								
								<div class="col-6 col-12-xsmall">
									<div class="td_a_6"><span>＊</span>中文姓名：</div>
									<div class="td_b_6"><input type="text" name="cname" id="cname" style="width:100%;" value="<?php echo $base_cname ?>"  /></div>
								</div>
								<div class="col-6 col-12-xsmall">
									<div class="td_a_6">英文名字：</div>
									<div class="td_b_6"><input type="text" name="ename" id="ename" style="width:100%;" value="<?php echo $base_ename ?>"  /></div>
								</div>
								<div class="col-6 col-12-xsmall">
									<div class="td_a_6"><span>＊</span>性別：</div>
									<div class="td_b_6">
										<select name="gender" id="gender">
										<option value=""></option>
										<option value="1" <?php echo $selstr_gender_1;?>>男性</option>
										<option value="2" <?php echo $selstr_gender_2;?>>女性</option>
										</select>
									</div>									
								</div>
								<div class="col-6 col-12-xsmall">
									<div class="td_a_6"><span>＊</span>婚姻狀況：</div>
									<div class="td_b_6">
										<select name="marital" id="marital">
										<option value=""></option>
										<option value="1" <?php echo $selstr_marital_1;?>>已婚</option>
										<option value="2" <?php echo $selstr_marital_2;?>>未婚</option>
										<option value="3" <?php echo $selstr_marital_3;?>>暫不提供</option>
										</select>
									</div>									
								</div>
								<div class="col-12 col-12-xsmall">
									<div class="td_a_6"><span>＊</span>出生日期：</div>
									<div class="td_b_6">
										西元
										<select class="w170" name="birthdayYear" id="birthdayYear">
										<option value=""></option>
										<?php echo $selstr_birthdayYear; ?>
										</select>年
		
										<select name="birthdayMonth" id="birthdayMonth">
										<option value=""></option>
										<?php echo $selstr_birthdayMonth; ?>
										</select>月
										<select name="birthdayDate" id="birthdayDate">
										<option value=""></option>
										<?php echo $selstr_birthdayDate; ?>
										</select>日
									</div>										
								</div>
								<div class="col-12 col-12-xsmall">
									<div class="td_a_6"><span>＊</span>E-mail：</div>
									<div class="td_b_6"><input type="text" name="email" id="email" style="width:100%;" value="<?php echo $base_email ?>"  /></div>
								</div>
								<div class="col-6 col-12-xsmall">
									<div class="td_a_6">聯絡電話：</div>
									<div class="td_b_6"><input type="text" name="call_phone" id="call_phone" style="width:100%;" value="<?php echo $base_call_phone ?>"  /></div>
								</div>
								<div class="col-6 col-12-xsmall">
									<div class="td_a_6">聯絡時間：</div>
									<div class="td_b_6"><input type="text" name="call_time" id="call_time" style="width:100%;" value="<?php echo $base_call_time ?>"  /></div>
								</div>
								<div class="col-12 col-12-xsmall">
									<div class="td_a_6">通訊地址：</div>
									<div class="td_b_6"><input type="text" name="address" id="address" style="width:100%;" value="<?php echo $base_address ?>"  /></div>
								</div>
								<div class="col-12 col-12-xsmall">
									<div class="td_a_6">個人照片：</div>
									<div class="td_b_6">
									<?php echo $selstr_pic;?>	
									<input type="file" name="picfile" id="picfile" style="width:100%;line-height: 2.75em;" /><br>
										圖檔格式限jpg或PNG格式。<br>
										為節省您上傳等待時間，檔案大小請勿超過5MB。<br>
									</div>
								</div>
								<div class="col-12 col-12-xsmall" style="padding:1em 0 2em 0;text-align:center;">
									<input type="submit" name="submit" id="sub_basedata" value=" 儲存 " />                       
									<input type="hidden" name="sub_basedata" value="1">
									<input type="hidden" name="rpk" value="<?php echo $resume_pk?>">
								</div>               
								
							</div>
						</form>
					</section>
<!-- *********************************************************** -->
				</div>
			</section>
		</article>
	</div>

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrollex.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="js/timeout.js"></script>
	<script src="js/form.js"></script>

</body>
</html>