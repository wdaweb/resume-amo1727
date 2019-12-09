<?php
include_once '../include/_common.php';
if (empty($_SESSION['userpk'])) {
	fun_alertmsg ('尚未登入或閒置時間過長，請重新登入!!','index.php');
	exit;
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
					<h2>履歷管理</h2>
<!-- *********************************************************** -->
					<section style="margin: 0 0 3em 0;">
						<a href="javascript:void(0);" onClick="return displayformAdd('formAdd_resume');" style="float:right;">新增履歷</a>
						<div class="clear"></div>

						<div id="formAdd_resume" class="formAdd" style="display:none;" >
							<form action="resume_add_api.php" method="post" onsubmit="return chk_resumeForm(this);">
								<div class="row gtr-uniform">											
									<div class="col-6 col-12-xsmall">
										<div class="td_a_5">履歷名稱：</div>
										<div class="td_b_5"><input type="text" name="resume_name" id="resume_name" style="width:100%;" value=""  /></div>
									</div>
									<div class="col-6 col-12-xsmall">
										<input type="submit" name="submit" value=" 儲存 " />
										<input type="hidden" name="sub_resumeAdd" value="1">
									</div>             
								</div>
							</form>
						</div>

						<?php
						$rows=fun_all("resume");
						foreach ($rows as $v) {
							$resume_status_0="";
							$resume_status_1="";
							if ($v["resume_status"] == 1) {
								$resume_status_1="selected";
							} else {
								$resume_status_0="selected";
							}
						?>
						<div class="formEdit">
							<form enctype="multipart/form-data" action="resume_edit_api.php" method="post" onsubmit="return chk_resumeForm(this);">
								<div class="row gtr-uniform">											
									<div class="col-4 col-12-xsmall">
										<div class="td_a_5">履歷名稱：</div>
										<div class="td_b_5"><input type="text" name="resume_name" id="resume_name" style="width:100%;" value="<?php echo $v["resume_name"]?>"  /></div>
									</div>
									<div class="col-4 col-12-xsmall">
										<div class="td_a_5">履歷狀態：</div>
										<div class="td_b_5">
											<select name="resume_status" id="resume_status">
											<option value="0" <?php echo $resume_status_0?>>關閉</option>
											<option value="1" <?php echo $resume_status_1?>>開啟</option>
											</select>
										</div>
									</div>
									<div class="col-4 col-12-xsmall">
										<input type="submit" name="submit" value=" 儲存 " />
										<input type="hidden" name="sub_resumeEdit" value="1">
										<input type="hidden" name="upk" value="<?php echo $v["pk"]?>">
									</div>
									<div class="col-12 col-12-xsmall">
										<div class="td_a_5">內容設定：</div>
										<div class="td_b_5">
											[<a href="basedata.php?rpk=<?php echo $v["pk"]?>">基本資料</a>] 
											[<a href="experience.php?rpk=<?php echo $v["pk"]?>">學經歷</a>] 
											[<a href="skills.php?rpk=<?php echo $v["pk"]?>">技能</a>] 
											[<a href="description.php?rpk=<?php echo $v["pk"]?>">簡述</a>]
											[<a href="autobiography.php?rpk=<?php echo $v["pk"]?>">自傳</a>]
											[<a href="portfolio.php?rpk=<?php echo $v["pk"]?>">作品集</a>]
											[<a href="jobhunting.php?rpk=<?php echo $v["pk"]?>">求職條件</a>]
										</div>
									</div>          
								</div>
							</form>
						</div>
						<?php 
						}
						?>
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