<?php
include_once '../include/_common.php';
if (empty($_SESSION['userpk'])) {
	fun_alertmsg ('尚未登入或閒置時間過長，請重新登入!!','index.php');
	exit;
}
include './include/_resume.php';

$jobh_job_name="";
$jobh_job_desc="";
$jobh_work_area="";
$jobh_work_salary_kind="";
$jobh_work_salary_s="";
$jobh_work_salary_e="";
if (!empty($resume_pk)) {
	$result=fun_findDB_jobhunting($_SESSION['userpk'],$resume_pk);
	if ($result) {
		$jobh_pk=$result["pk"];
		$jobh_job_name=$result["job_name"];
		$jobh_job_desc=$result["job_desc"];
		$jobh_work_area=$result["work_area"];
		$jobh_work_salary_kind=$result["work_salary_kind"];
		$jobh_work_salary_s=$result["work_salary_s"];
		$jobh_work_salary_e=$result["work_salary_e"];
	}
}

$selstr_salarykind_9 = "";
$selstr_salarykind_1 = "";
$selstr_salarykind_2 = "";
$selstr_salarykind_3 = "";
$work_salary3_styleStr = "style='display:none;'";
if ($jobh_work_salary_kind == 1) {
	$selstr_salarykind_1 = "selected";
} else if ($jobh_work_salary_kind == 2) {
	$selstr_salarykind_2 = "selected";
} else if ($jobh_work_salary_kind == 3) {
	$selstr_salarykind_3 = "selected";
	$work_salary3_styleStr = "style='display:black;'";
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
					<h2>求職條件</h2>
<!-- *********************************************************** -->
					<section>
						<form class="formEdit" action="jobhunting_api.php" method="post" id="jobhuntingForm" onsubmit="return chk_jobhuntingForm(this);">
							<div class="row gtr-uniform">	                    
								
								<div class="col-12 col-12-xsmall">
									<div class="td_a_8"><span>＊</span>希望職務名稱：</div>
									<div class="td_b_8"><input type="text" name="job_name" id="job_name" style="width:100%;" value="<?php echo $jobh_job_name ?>"  /></div>
								</div>
								<div class="col-12 col-12-xsmall">
									<div class="td_a_8">職務內容描述：</div>
									<div class="td_b_8">
										<textarea name="job_desc" rows="5" style="width:100%;"><?php echo $jobh_job_desc?></textarea>
									</div>
								</div>
								<div class="col-12 col-12-xsmall">
									<div class="td_a_8">希望工作地點：</div>
									<div class="td_b_8"><input type="text" name="work_area" id="work_area" style="width:100%;" value="<?php echo $jobh_work_area ?>"  /></div>
								</div>
								<div class="col-12 col-12-xsmall">
									<div class="td_a_8"><span>＊</span>希望薪資待遇：</div>
									<div class="td_b_8">
										<select name="work_salary_kind" id="work_salary_kind">
										<option value="" >不顯示</option>
										<option value="1" <?php echo $selstr_salarykind_1;?>>面議</option>
										<option value="2" <?php echo $selstr_salarykind_2;?>>依公司規定</option>
										<option value="3" <?php echo $selstr_salarykind_3;?>>指定</option>
										</select>
										<div id="work_salary3" <?php echo $work_salary3_styleStr;?>>
											<br>NT$
											<input type="text" name="work_salary_s" id="work_salary_s" size="6" value="<?php echo $jobh_work_salary_s ?>"  /> ~ 
											<input type="text" name="work_salary_e" id="work_salary_e" size="6" value="<?php echo $jobh_work_salary_e ?>"  />元
										</div>
									</div>									
								</div>
								<div class="col-12 col-12-xsmall" style="padding:1em 0 2em 0;text-align:center;">
									<input type="submit" name="submit" id="sub_jobhunting" value=" 儲存 " />                       
									<input type="hidden" name="sub_jobhunting" value="1">
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