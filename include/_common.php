<?php 
    session_start();
    $db_server='localhost';
    $db_user='dbresume';
    $db_pwd='dbresume1727';
    $db_name='dbresume';
    $pdo=new PDO("mysql:host=$db_server;charset=utf8;dbname=$db_name",$db_user,$db_pwd);

    function fun_testinput($datatestinput) {
        if (!empty($datatestinput)) {
            $datatestinput = trim($datatestinput);
            $datatestinput = stripslashes($datatestinput);  
            $datatestinput = htmlspecialchars($datatestinput);
        } else {
            $datatestinput='';
        }
        return $datatestinput;
    }
    function fun_alertmsg($msg,$link){
        $alertmsg = "<script>\n";
        $alertmsg .= "alert('". $msg ."');\n";
        $alertmsg .= "location.href='".$link."';\n";
        $alertmsg .= "</script>\n";
        echo $alertmsg;
    }
    
    // 更新資料。
    function fun_updateDB($table,$pk,$data){
        global $pdo;
        $updatesdtr="";
        foreach ($data as $key => $value) {
            $updatesdtr.=",`". $key ."`='". $value ."'";
        }       
        $updatesdtr=substr($updatesdtr, 1);
        $sql="UPDATE `". $table ."` SET ". $updatesdtr ." WHERE pk ='". $pk ."'";
        $result = $pdo->exec($sql);
        return $result;
    }    
    // 新增資料
    function fun_insertDB($table,$data){
        global $pdo;
        
        $keys="`". implode("`,`",array_keys($data)) ."`";
        $values="'". implode("','",$data) ."'";
        $sql="INSERT INTO ". $table ."(". $keys .") VALUES (". $values .")";
        $result = $pdo->exec($sql);
        return $result;
    }

    function fun_dbDataEdit($table,$data,$pk,$sortuu){
        global $pdo;
        if (!empty($pk)) {
            $updatesdtr="";
            foreach ($data as $key => $value) {
                $updatesdtr.=",`". $key ."`='". $value ."'";
            }       
            $updatesdtr=substr($updatesdtr, 1);
            $sql="UPDATE `". $table ."` SET ". $updatesdtr ." WHERE pk ='". $pk ."'";
            $result = $pdo->exec($sql);  
            return $result;    
        } else {
            $keys="`". implode("`,`",array_keys($data)) ."`";
            $values="'". implode("','",$data) ."'";
            $sql="INSERT INTO ". $table ."(". $keys .") VALUES (". $values .")";
            $result = $pdo->exec($sql);
            if (!empty($result)) {
                if ($sortuu == "1") {
                    $sql1="select pk from ". $table ." order by pk DESC";
                    $row1 = $pdo->query($sql1)->fetch(PDO::FETCH_ASSOC);
                    if (!empty($row1)) {
                        $sql2="UPDATE `". $table ."` SET `sort`='". $row1["pk"] ."' WHERE pk ='". $row1["pk"] ."'";
                        $result2 = $pdo->exec($sql2);  
                        return $result2;
                    } else {
                        return false;
                    }
                } else {
                    return true;
                }   
            } else {
                return false;
            }
        }
    }
    // 刪除資料
    function fun_delDB($table,$pk){
        global $pdo;
        $sql="DELETE FROM  `". $table ."` WHERE pk ='". $pk ."'";
        $result = $pdo->exec($sql);
        return $result;
    }

    // 查資料(多筆)
    function fun_all($table){
        global $pdo;
        $sql="select * from ".$table;
        $rows=$pdo->query($sql)->fetchAll();
        return $rows;
    }

    // 查資料(單筆)
    function fun_loginDB($acc,$pw){
        global $pdo;
        $sql="SELECT * FROM `user` where acc = '". $acc ."' and pw = '" . $pw ."' and enable = '1' ";
        $rows = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    function fun_findDB_resume($user_pk,$pk){
        global $pdo;
        $sql="SELECT * FROM `resume` where pk = '". $pk ."' and user_pk ='". $user_pk ."'";
        $rows = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    function fun_findDB_basedata($user_pk,$resume_pk){
        global $pdo;
        $sql="SELECT * FROM `basedata` where resume_pk = '". $resume_pk ."' and user_pk ='". $user_pk ."'";
        $rows = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    function fun_findDB_autobiography($user_pk,$resume_pk){
        global $pdo;
        $sql="SELECT * FROM `autobiography` where resume_pk = '". $resume_pk ."' and user_pk ='". $user_pk ."'";
        $rows = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }
    function fun_findDB_description($user_pk,$resume_pk){
        global $pdo;
        $sql="SELECT * FROM `description` where resume_pk = '". $resume_pk ."' and user_pk ='". $user_pk ."'";
        $rows = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }
    function fun_findDB_jobhunting($user_pk,$resume_pk){
        global $pdo;
        $sql="SELECT * FROM `jobhunting` where resume_pk = '". $resume_pk ."' and user_pk ='". $user_pk ."'";
        $rows = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    
    //產生驗證碼文字
    function fun_VerificationCodeID($len){  
        //宣告一個空字串變數
        $code="";
        //利用迴圈來累加字串
        for($i=0;$i<$len;$i++){
            //宣告一個亂數變數來決定每次迴圈要產生的是數字還是大小寫英文字
            $type=rand(1,3);
            //利用switch case來切換字元的類型
            switch($type){
                case "1":
                //產生亂數的數字
                $code=$code . rand(0,9);
                break;
                case "2":
                //產生亂數的小寫英文
                $code=$code . chr(rand(97,122));
                break;
                case "3":
                //產生亂數的大寫英文
                $code=$code . chr(rand(65,90));
                break;
            }
        }
        return $code;
    }

    //產生驗證碼圖片
    function fun_VerificationCodeImg($VID,$type){
        //設定字型資訊
        $fontsize=20;
        $font=rand(0,3);;
        //建立字型清單陣列,需先確認相關目錄下有ttf字型檔
        // $fontlist=['Achafexp.ttf','Achafita.ttf','Achaflft.ttf','Achafont.ttf'];
        $fontlist=['Courier.ttf','Georgia.ttf','Verdana.ttf','Arial.ttf'];
        //設定字形檔的路徑(需要絕對路徑)
        $fontpath=realpath("./font/$fontlist[$font]");

        //先計算出字形字串佔用的區域坐標
        $text_box=imagettfbbox($fontsize,0,$fontpath,$VID);
        $img_w=$text_box[2]+strlen($VID)*10; //利用坐標來算出圖片的寬度並加上間距
        $img_h=$text_box[7]*-1+35;  //利用坐標來算出圖片的高度並加上亂數Y坐標的範圍15及上下邊距20
        //建立一個用來存放驗證碼的圖片資源,全彩
        $img=imagecreatetruecolor($img_w,$img_h);

        //設定一個背景色
        $bg=imagecolorallocate($img,255,200,255);
        
        //填上背景色
        imagefill($img,0,0,$bg);
        //先在底圖上畫線條
        $lines=rand(2,4);   //亂數決定線條數
        for($i=0;$i<$lines;$i++){
            //根據函式需要來產生需要的坐標資訊及色彩
            $start_x=rand(5,intval($img_w*0.25));  //在圖片0~1/4的範圍內產生一個x坐標點
            $start_y=rand(10,$img_h-10);           //在驗證碼的高度範圍內產生一個y坐標點
            $end_x=rand(intval($img_w*0.75+5),$img_w-5);    //在圖片3/4~1的範圍內產生一個x坐標點
            $end_y=rand(10,$img_h-10);                      //在驗證碼的高度範圍內產生一個y坐標點
            //用亂數產色一個色彩
            $line_color=imagecolorallocate($img,rand(50,200),rand(50,200),rand(50,200));
            //執行畫線函式
            imageline($img,$start_x,$start_y,$end_x,$end_y,$line_color);
        }
        //在底圖上畫文字
        $str_x=5; //預設從底圖左側5點的地方開始畫
        $str_y=0; 
        //使用迴圈依照驗證碼的字串長度來畫出文字
        for($i=0;$i<strlen($VID);$i++){
            $color=imagecolorallocate($img,rand(50,200),rand(50,200),rand(50,200));
            //內建字形的畫字函式->imagestring($img,5,$str_x,$str_y,substr($VID,$i,1),$color);
            // imagettfbbox() -> image true type font bounding box -用來取得字形的四點坐標資訊(左下,右下,右上,左上);
            //取得毎個字元的四角坐標值
            $textbox=imagettfbbox($fontsize,0,$fontpath,substr($VID,$i,1));

            //計算字元在Y軸的位置(上邊距+亂數範圍+字形高度)
            $str_y=10+rand(0,15)+$textbox[7]*-1;

            //用亂數產生一個-30~30的傾斜角度
            $angle=rand(-30,30);
            //將單一字元畫在底圖上
            imagettftext($img,$fontsize,$angle,$str_x,$str_y,$color,$fontpath,substr($VID,$i,1));

            //計算下一個字元在X軸的位置(將上一個字元的x坐標加上字元的寬度),再加上10px的字元間距
            $str_x=$str_x+$textbox[2]+10;
        }
        if ($type == "1") {
            ob_clean(); //清空緩衝區但不回傳(如果驗證碼輸出不了，加上這一句就可以輸出了)
            header("Content-Type:image/png"); 
            imagepng($img);                     //生成png格式   
        } else {
            //儲存成png檔案
            imagepng($img,"./images/VCode.png");
        }
        ImageDestroy($img);   
    }

    function fun_reSizeImg($dstWidth,$dstQuality,$srcPath,$dstPath){
        //取得來源圖片資訊
        $imgInfo=getimagesize($srcPath);
    
        //圖片格式
        $imgInfo_type=$imgInfo[2];
        if ($imgInfo_type != 1 && $imgInfo_type != 2 && $imgInfo_type != 3) {
            return false;
        }
    
        //計算縮放後的大小
        if (!empty($dstWidth)) {
            $rate=$dstWidth/$imgInfo[0];
        }
        $dst_w=$dstWidth;
        $dst_h=$imgInfo[1]*$rate;
    
        //建立縮圖圖層畫布及來源圖片轉成圖形資源
        $dstImg=imagecreatetruecolor($dst_w,$dst_h);
        if ($imgInfo_type==1) {
            $srcImg=imagecreatefromgif($srcPath);
        } else if($imgInfo_type==2) {
            $srcImg=imagecreatefromjpeg($srcPath);
        } else if($imgInfo_type==3) {
            $srcImg=imagecreatefrompng($srcPath);
        }
    
        //進行縮放
        imagecopyresampled($dstImg,$srcImg,0,0,0,0,$dst_w,$dst_h,$imgInfo[0],$imgInfo[1]);
    
        //儲存縮圖
        if ($imgInfo_type==1) {
            imagegif($dstImg,$dstPath);
        } else if($imgInfo_type==2) {
            imagejpeg($dstImg,$dstPath,$dstQuality);
        } else if($imgInfo_type==3) {
            imagepng($dstImg,$dstPath);
        }
    }
    function fun_ChkDate($str){
        $DateArr=explode('-',$str);
        if (count($DateArr) == 3) {
            return checkdate($DateArr[1], $DateArr[2], $DateArr[0]);
        } else {
            return false;
        }
    }

    function fun_ChkEmail($str){
        if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $str)){
            return false;
        }else{
            return true;
        }
    }


?>