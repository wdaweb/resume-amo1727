<?php
$resume_menustr="";
if (!empty($resume_pk)) {
	$resume_menustr='<li><a href="manage.php">履歷管理</a></li>';
	$resume_menustr.='<li>';
	$resume_menustr.='<h3>履歷名：'. $resume_name .'</h3>';
	$resume_menustr.='<ol>';
	$resume_menustr.='<li><a href="basedata.php?rpk='. $resume_pk .'">基本資料</a></li>';
	$resume_menustr.='<li><a href="experience.php?rpk='. $resume_pk .'">學經歷</a></li>';
	$resume_menustr.='<li><a href="skills.php?rpk='. $resume_pk .'">技能</a></li>';
	$resume_menustr.='<li><a href="description.php?rpk='. $resume_pk .'">簡述</a></li>';
	$resume_menustr.='<li><a href="autobiography.php?rpk='. $resume_pk .'">自傳</a></li>';
	$resume_menustr.='<li><a href="portfolio.php?rpk='. $resume_pk .'">作品集</a></li>';
	$resume_menustr.='<li><a href="Jobhunting.php?rpk='. $resume_pk .'">求職條件</a></li>';
	$resume_menustr.='</ol>';
	$resume_menustr.='</li>';
}
?>
<header id="header">
	<h1>個人履歷系統</h1>
	<nav id="nav">
		<ul>
			<li class="special">
				<a href="#menu" class="menuToggle"><span>Menu</span></a>
				<div id="menu">
					<span class="timeout" id="timeout">登入時間剩餘 <em>x</em> 秒</span>
					<ul>
						<?php echo $resume_menustr;?>	
						<li>
							<a href="./index.php?logout=1">登出</a>
						</li>
						<li><a href="../" target="_blank">前台頁面</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</nav>
</header>
