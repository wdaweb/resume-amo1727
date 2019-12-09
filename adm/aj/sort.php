<?php
include_once '../../include/_common.php';
if (empty($_SESSION['userpk'])) {
	fun_alertmsg ('尚未登入或閒置時間過長，請重新登入!!','index.php');
	exit;
}
$success="0";
if (!empty($_POST["tablen"]) && !empty($_POST["pk"]) && !empty($_POST["act"])) {
    $prev_pk="";
    $next_pk="";
    $sql0="select * from ".$_POST["tablen"]. " where pk ='". $_POST["pk"] ."'";
    $row0 = $pdo->query($sql0)->fetch(PDO::FETCH_ASSOC);
    if (!empty($row0)) {
        $sort_0=$row0['sort'];
        // 下一筆
        if ($_POST["act"]=="down") {
            $sql1="select pk,sort from ".$_POST["tablen"]. " where user_pk ='". $row0['user_pk'] ."' and resume_pk = '". $row0['resume_pk'] ."' and sort > ". $row0['sort'] ." order by sort asc limit 1" ;
            $rows1=$pdo->query($sql1)->fetch(PDO::FETCH_ASSOC);
            if (!empty($rows1)) {
               
                $next_pk=$rows1['pk'];

                $editdata_a=[];
                $editdata_a['sort']=$rows1['sort']; 
                $result_a=fun_dbDataEdit($_POST["tablen"],$editdata_a,$_POST["pk"],"");

                $editdata_b=[];
                $editdata_b['sort']=$sort_0; 
                $result_b=fun_dbDataEdit($_POST["tablen"],$editdata_b,$rows1['pk'],"");

                $success="1";
                
            }
        }
               
        // 上一筆
        if ($_POST["act"]=="up") {
            $sql2="select * from ".$_POST["tablen"]. " where user_pk ='". $row0['user_pk'] ."' and resume_pk = '". $row0['resume_pk'] ."' and sort < ". $row0['sort'] ." order by sort desc limit 1" ;
            $rows2=$pdo->query($sql2)->fetch(PDO::FETCH_ASSOC);
            if (!empty($rows2)) {
                $prev_pk=$rows2['pk'];

                $editdata_a=[];
                $editdata_a['sort']=$rows2['sort']; 
                $result_a=fun_dbDataEdit($_POST["tablen"],$editdata_a,$_POST["pk"],"");

                $editdata_b=[];
                $editdata_b['sort']=$sort_0; 
                $result_b=fun_dbDataEdit($_POST["tablen"],$editdata_b,$rows2['pk'],"");

                $success="1";
            }
            // $success=$sql2;
        }
    }
}
echo $success;
?>