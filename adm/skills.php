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
					<h2>技能</h2>
					<!-- **************************************************************** -->
					<section >
						<a href="javascript:void(0);" onClick="return displayformAdd('formAdd_skills');" style="float:right;">新增技能</a>
						<div class="clear"></div>

						<div id="formAdd_skills" class="formAdd" style="display:none;" >
							<form id="skillsFormAdd" action="skills_api.php" method="post" onsubmit="return chk_skillsForm(this);">
								<div class="row gtr-uniform">											
									<div class="col-12 col-12-xsmall">
										<div class="td_a_3">標題：</div>
										<div class="td_b_3"><input type="text" name="skill_title" style="width:100%;" value=""  /></div>
									</div>
									<div class="col-12 col-12-xsmall">
										<div class="td_a_3">內容：</div>
										<div class="td_b_3"><textarea name="skill_content" rows="10" style="width:100%;"></textarea></div>
									</div>
									<div class="col-12 col-12-xsmall">
										<input type="submit" name="submit" value=" 儲存 " />
										<input type="hidden" name="sub_skills" value="1">
										<input type="hidden" name="rpk" value="<?php echo $resume_pk; ?>">
									</div>               
								</div>
							</form>
						</div>
						<?php
						$sql="select * from skills where user_pk ='". $_SESSION["userpk"] ."' and resume_pk = '". $resume_pk ."' order by sort ";
						$rows=$pdo->query($sql)->fetchAll();
						$ski_ii = 0;
						foreach ($rows as $v) {
							$ski_ii++;

							$str_datashow="";
							if ($v["datashow"] == 1) {
								$str_datashow="checked";
							}
						?>
						<div class="formEdit">
							<form id="skillsFormEdit" action="skills_api.php" method="post" onsubmit="return chk_skillsForm(this);">
								<div class="row gtr-uniform">											
									<div class="col-12 col-12-xsmall">
										<input type="checkbox" name="datashow" value="1" <?php echo $str_datashow ?>>
											<label for="datashow">顯示此則訊息</label>
									</div>	
									<div class="col-12 col-12-xsmall">
										<div class="td_a_3">標題：</div>
										<div class="td_b_3"><input type="text" name="skill_title" style="width:100%;" value="<?php echo $v["skill_title"]?>"  /></div>
									</div>
									<div class="col-12 col-12-xsmall">
										<div class="td_a_3">內容：</div>
										<div class="td_b_3"><textarea name="skill_content" rows="10" style="width:100%;"><?php echo $v["skill_content"]?></textarea></div>
									</div>
									<div class="col-12 col-12-xsmall">
										<div style="float:left;">
											<input type="submit" name="submit" value=" 儲存 " />
											<input type="hidden" name="sub_skills" value="1">
											<input type="hidden" name="ski_pk" value="<?php echo $v["pk"]?>">
											<input type="hidden" name="rpk" value="<?php echo $resume_pk?>">
										</div>
										<div style="float:right;padding:0 3em; 0 0;">
											<a href="javascript:void(0);" onClick="return fun_deleteData('skills','<?php echo $v["pk"]?>')">刪除此則</a>　
										</div>
										<div style="float:right;padding:0 3em; 0 0;">
											排序：[<a href="javascript:void(0)" onClick="return fun_changeSortData('skills','<?php echo $v["pk"]?>','up')">向上</a>] [<a href="javascript:void(0)" onClick="return fun_changeSortData('skills','<?php echo $v["pk"]?>','down')">向下</a>]
										</div>
									</div>               
								</div>
							</form>
						</div>
						<?php 
						}
						?>
						<?php 
						if ($ski_ii == 0) {
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