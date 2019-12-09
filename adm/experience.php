<?php
include_once '../include/_common.php';
if (empty($_SESSION['userpk'])) {
	fun_alertmsg ('尚未登入或閒置時間過長，請重新登入!!','index.php');
	exit;
}
include './include/_resume.php';
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
					<h2>學經歷管理</h2>
					<!-- **************************************************************** -->
					<section >
						<h3 style="float:left;">學歷</h3>
						<a href="javascript:void(0);" onClick="return displayformAdd('formAdd_education');" style="float:right;">新增學歷</a>
						<div class="clear"></div>

						<div id="formAdd_education" class="formAdd" style="display:none;" >
							<form id="educationFormAdd" action="education_api.php" method="post" onsubmit="return chk_educationForm(this);">
								<div class="row gtr-uniform">											
									<div class="col-6 col-12-xsmall">
										<div class="td_a_3">學校：</div>
										<div class="td_b_3"><input type="text" name="school_name" style="width:100%;" value=""  /></div>
									</div>
									<div class="col-6 col-12-xsmall">
										<div class="td_a_3">科系：</div>
										<div class="td_b_3"><input type="text" name="major_name" style="width:100%;" value=""  /></div>
									</div>
									<div class="col-6 col-12-xsmall">
										<div class="td_a_3">期間：</div>
										<div class="td_b_3"><input type="text" name="study_datelist" style="width:100%;" value=""  /></div>
									</div>
									<div class="col-6 col-12-xsmall">
										<div class="td_a_3">狀態：</div>
										<div class="td_b_3">
											<select name="study_status" >
											<option value=""></option>
											<option value="1">畢業</option>
											<option value="2">肄業</option>
											<option value="3">就學中</option>
											</select>
										</div>
									</div>
									<div class="col-12 col-12-xsmall">
										<input type="submit" name="submit" value=" 儲存 " />
										<input type="hidden" name="sub_education" value="1">
										<input type="hidden" name="rpk" value="<?php echo $resume_pk; ?>">
									</div>               
								</div>
							</form>
						</div>
						<?php
						$sql="select * from education where user_pk ='". $_SESSION["userpk"] ."' and resume_pk = '". $resume_pk ."' order by sort ";
						$rows=$pdo->query($sql)->fetchAll();
						$edu_ii = 0;
						foreach ($rows as $v) {
							$edu_ii++;

							$str_datashow="";
							if ($v["datashow"] == 1) {
								$str_datashow="checked";
							}
							$str_status_1="";
							$str_status_2="";
							$str_status_3="";
							if ($v["study_status"] == 1) {
								$str_status_1="selected";
							} else if ($v["study_status"] == 2) {
								$str_status_2="selected";
							} else if ($v["study_status"] == 3) {
								$str_status_3="selected";
							}
						?>
						<div class="formEdit">
							<form id="educationFormEdit" action="education_api.php" method="post" onsubmit="return chk_educationForm(this);">
								<div class="row gtr-uniform">											
									<div class="col-12 col-12-xsmall">
										<input type="checkbox" name="datashow" value="1" <?php echo $str_datashow ?>>
											<label for="datashow">顯示此則訊息</label>
									</div>	
									<div class="col-6 col-12-xsmall">
										<div class="td_a_3">學校：</div>
										<div class="td_b_3"><input type="text" name="school_name" style="width:100%;" value="<?php echo $v["school_name"]?>"  /></div>
									</div>
									<div class="col-6 col-12-xsmall">
										<div class="td_a_3">科系：</div>
										<div class="td_b_3"><input type="text" name="major_name" style="width:100%;" value="<?php echo $v["major_name"]?>"  /></div>
									</div>
									<div class="col-6 col-12-xsmall">
										<div class="td_a_3">期間：</div>
										<div class="td_b_3"><input type="text" name="study_datelist" style="width:100%;" value="<?php echo $v["study_datelist"]?>"  /></div>
									</div>
									<div class="col-6 col-12-xsmall">
										<div class="td_a_3">狀態：</div>
										<div class="td_b_3">
											<select name="study_status" >
											<option value="0"></option>
											<option value="1" <?php echo $str_status_1?>>畢業</option>
											<option value="2" <?php echo $str_status_2?>>肄業</option>
											<option value="3" <?php echo $str_status_3?>>就學中</option>
											</select>
										</div>
									</div>
									<div class="col-12 col-12-xsmall">
										<div style="float:left;">
											<input type="submit" name="submit" value=" 儲存 " />
											<input type="hidden" name="sub_education" value="1">
											<input type="hidden" name="edu_pk" value="<?php echo $v["pk"]?>">
											<input type="hidden" name="rpk" value="<?php echo $resume_pk?>">
										</div>
										<div style="float:right;padding:0 3em; 0 0;">
											<a href="javascript:void(0);" onClick="return fun_deleteData('education','<?php echo $v["pk"]?>')">刪除此則</a>　
										</div>
										<div style="float:right;padding:0 3em; 0 0;">
											排序：[<a href="javascript:void(0)" onClick="return fun_changeSortData('education','<?php echo $v["pk"]?>','up')">向上</a>] [<a href="javascript:void(0)" onClick="return fun_changeSortData('education','<?php echo $v["pk"]?>','down')">向下</a>]
										</div>
									</div>               
								</div>
							</form>
						</div>
						<?php 
						}
						?>
						<?php 
						if ($edu_ii == 0) {
							echo '<div class="formEdit" style="padding:1em;text-align:center;">目前無資料.</div';
						}
						?>
					</section>

					<!-- **************************************************************** -->
					
					<section style="padding: 5em 0 0 0;">
						<h3 style="float:left;">經歷</h3>
						<a href="javascript:void(0);" onClick="return displayformAdd('formAdd_experience');" style="float:right;">新增經歷</a>
						<div class="clear"></div>

						<div id="formAdd_experience" class="formAdd" style="display:none;" >
							<form id="experienceFormAdd" action="experience_api.php" method="post" onsubmit="return chk_experienceForm(this);">
								<div class="row gtr-uniform">											
									<div class="col-6 col-12-xsmall">
										<div class="td_a_5">公司名稱：</div>
										<div class="td_b_5"><input type="text" name="com_name" style="width:100%;" value=""  /></div>
									</div>
									<div class="col-6 col-12-xsmall">
										<div class="td_a_5">職務名稱：</div>
										<div class="td_b_5"><input type="text" name="job_name" style="width:100%;" value=""  /></div>
									</div>
									<div class="col-6 col-12-xsmall">
										<div class="td_a_5">任職期間：</div>
										<div class="td_b_5"><input type="text" name="job_datelist" style="width:100%;" value=""  /></div>
									</div>
									<div class="col-6 col-12-xsmall">
										<div class="td_a_5">狀態：</div>
										<div class="td_b_5">
											<input type="checkbox" name="job_status" value="1">
											<label for="job_status">仍在職</label>
										</div>
									</div>
									<div class="col-12 col-12-xsmall">
										工作內容： <br>
										<textarea name="job_content" placeholder="請輸入與此工作相關的工作內容" rows="6" style="width:100%;"></textarea>
									</div>    
									<div class="col-12 col-12-xsmall">
										<input type="submit" name="submit" value=" 儲存 " />
										<input type="hidden" name="sub_experience" value="1">
										<input type="hidden" name="rpk" value="<?php echo $resume_pk; ?>">
									</div>               
								</div>
							</form>
						</div>
						<?php
						$sql="select * from experience where user_pk ='". $_SESSION["userpk"] ."' and resume_pk = '". $resume_pk ."' order by sort ";
						$rows=$pdo->query($sql)->fetchAll();
						$exp_ii = 0;
						foreach ($rows as $v) {
							$exp_ii++;
							$job_status="";
							if ($v["job_status"] == 1) {
								$job_status="checked";
							}
						?>
						<div class="formEdit">
							<form id="experienceFormEdit" action="experience_api.php" method="post" onsubmit="return chk_experienceForm(this);">
								<div class="row gtr-uniform">											
									<div class="col-12 col-12-xsmall">
										<input type="checkbox" name="datashow" value="1" <?php echo $str_datashow ?>>
										<label for="datashow">顯示此則訊息</label>
									</div>
									<div class="col-6 col-12-xsmall">
										<div class="td_a_5">公司名稱：</div>
										<div class="td_b_5"><input type="text" name="com_name" style="width:100%;" value="<?php echo $v["com_name"]?>"  /></div>
									</div>
									<div class="col-6 col-12-xsmall">
										<div class="td_a_5">職務名稱：</div>
										<div class="td_b_5"><input type="text" name="job_name" style="width:100%;" value="<?php echo $v["job_name"]?>"  /></div>
									</div>
									<div class="col-6 col-12-xsmall">
										<div class="td_a_5">任職期間：</div>
										<div class="td_b_5"><input type="text" name="job_datelist" style="width:100%;" value="<?php echo $v["job_datelist"]?>"  /></div>
									</div>
									<div class="col-6 col-12-xsmall">
										<div class="td_a_5">狀態：</div>
										<div class="td_b_5">
											<input type="checkbox" name="job_status" value="1" <?php echo $job_status;?>>
											<label for="job_status">仍在職</label>
										</div>
									</div>
									<div class="col-12 col-12-xsmall">
										工作內容： <br>
										<textarea name="job_content" placeholder="請輸入與此工作相關的工作內容" rows="6" style="width:100%;"><?php echo $v["job_content"]?></textarea>
									</div>  
									<div class="col-12 col-12-xsmall">
										<div style="float:left;">
											<input type="submit" name="submit" value=" 儲存 " />
											<input type="hidden" name="sub_experience" value="1">
											<input type="hidden" name="exp_pk" value="<?php echo $v["pk"];?>">
											<input type="hidden" name="rpk" value="<?php echo $resume_pk; ?>">
										</div>
										<div style="float:right;padding:0 3em; 0 0;">
											<a href="javascript:void(0);" onClick="return fun_deleteData('experience','<?php echo $v["pk"]?>')">刪除此則</a>　
										</div>
										<div style="float:right;padding:0 3em; 0 0;">
											排序：[<a href="javascript:void(0)" onClick="return fun_changeSortData('experience','<?php echo $v["pk"]?>','up')">向上</a>] [<a href="javascript:void(0)" onClick="return fun_changeSortData('experience','<?php echo $v["pk"]?>','down')">向下</a>]
										</div>
									</div>               
								</div>
							</form>
						</div>
						<?php 
						}
						?>
						<?php 
						if ($exp_ii == 0) {
							echo '<div class="formEdit" style="padding:1em;text-align:center;">目前無資料.</div';
						}
						?>
					</section>
					<!-- **************************************************************** -->


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