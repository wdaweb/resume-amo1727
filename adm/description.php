<?php
include_once '../include/_common.php';
if (empty($_SESSION['userpk'])) {
	fun_alertmsg ('尚未登入或閒置時間過長，請重新登入!!','index.php');
	exit;
}
include './include/_resume.php';

$a_info="";
$a_datashow="";
$str_datashow = "";
if (!empty($resume_pk)) {
	$result=fun_findDB_description($_SESSION['userpk'],$resume_pk);
	if ($result) {
		$a_pk=$result["pk"];
		$a_info=$result["info"];
		$a_datashow=$result["datashow"];
		if ($a_datashow == 1) {
			$str_datashow = "checked";
		}
	}
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
	<section id="page-wrapper">
		<?php include './include/_header.php';?>
		<article id="main">
			<section class="wrapper style5">
				<section class="inner">
					<h3>簡述管理</h3>
					<!-- **************************************************************** -->
					<section>
						<form id="descriptionForm" action="description_api.php" method="post">
							<div class="row gtr-uniform">	                    							
								<div class="col-12 col-12-xsmall">
									<input type="checkbox" name="datashow" value="1" <?php echo $str_datashow?>>
									<label for="datashow">前台顯示</label>
								</div>
								<div class="col-12 col-12-xsmall">
									<textarea name="info" placeholder="※ 請填寫簡單的自我宣傳文字" rows="20" style="width:100%;"><?php echo $a_info?></textarea>
								</div> 
								<div class="col-12 col-12-xsmall">
									<input type="submit" name="submit" id="sub_description" value=" 儲存 " />                       
									<input type="hidden" name="sub_description" value="1">
									<input type="hidden" name="rpk" value="<?php echo $resume_pk?>">
								</div>               
								
							</div>
						</form>
					</section>
				</section>
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