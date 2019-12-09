<?php
if (!empty($_GET["rpk"])) {
	$result=fun_findDB_resume($_SESSION['userpk'],fun_testinput($_GET["rpk"]));
	if (!empty($result)) {
		$resume_pk=$result["pk"];
		$resume_name=$result["resume_name"];
		$resume_status=$result["resume_status"];
	}else{
		header("location:manage.php");
	}
}else{
	header("location:manage.php");
}
?>
