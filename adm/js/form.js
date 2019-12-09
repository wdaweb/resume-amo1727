$("#work_salary_kind").on("click", function(){  
    msg = "";
    if ($("#work_salary_kind").val() == '3'){
        $("#work_salary3").show();
    }else if($("#work_salary_kind").val() == '1' || $("#work_salary_kind").val() == '2' || $("#work_salary_kind").val() == '3'){
        $("#work_salary3").hide();
    }
});

function displaySalaryKind(id){
    let fstyle = document.getElementById(id).style.display;
    if (fstyle=="none") {
        document.getElementById(id).style.display="block";
    } else {
        document.getElementById(id).style.display="none";
    }	
}

function displayformAdd(id){
    let fstyle = document.getElementById(id).style.display;
    if (fstyle=="none") {
        document.getElementById(id).style.display="block";
    } else {
        document.getElementById(id).style.display="none";
    }	
}

function chk_resumeForm(theForm){
    msg = '';
    if (theForm.resumeName.value == ''){
        msg = msg + '『履歷名稱』請填寫！ \n';
    }else{
        if (theForm.resumeName.value.length > 30){
            msg = msg + '『履歷名稱』格式錯誤！ \n';
        }
    }
    if (msg != ''){
        alert("資料有誤\n "+ msg );
        return false;	
    }else{
        return true;
    }   
}
$("#sub_basedata").on("click", function(){  
    msg = "";
    if (document.getElementById("cname").value == ''){
        msg = msg + '『中文姓名1』請填寫！ \n';
    }else{
        if (document.getElementById("cname").value.length > 20){
            msg = msg + '『中文姓名』格式錯誤！ \n';
        }
    }
    if (document.getElementById("ename").value == ''){
    }else{
        if (document.getElementById("ename").value.length > 30){
            msg = msg + '『英文姓名』格式錯誤！ \n';
        }
    }
    
    if (document.getElementById("gender").value == ''){
        msg = msg + '『性別』請選擇！ \n';
    }
    if (document.getElementById("marital").value == ''){
        msg = msg + '『婚姻狀況』請選擇！ \n';
    }
    if (document.getElementById("birthdayYear").value == '' || document.getElementById("birthdayMonth").value == '' || document.getElementById("birthdayDate").value == ''){
        msg = msg + '『出生日期』請選擇！ \n';
    }else{
        if (isExistDate(document.getElementById("birthdayYear").value+'-'+document.getElementById("birthdayMonth").value+'-'+document.getElementById("birthdayDate").value)==false){
            msg = msg + '『出生日期』格式錯誤！ \n';
        }
    } 
    
    if (document.getElementById("email").value == ''){
        msg = msg + '『E-mail』請填寫！ \n';
    }else{
        if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById("email").value)){
            msg = msg + '『E-mail』格式錯誤！ \n';
        }
    }
    
    if (document.getElementById("callphone").value == ''){
    }else{
        if (document.getElementById("callphone").value.length > 20){
            msg = msg + '『聯絡電話』格式錯誤！ \n';
        }
    }
    
    if (document.getElementById("calltime").value == ''){
    }else{
        if (document.getElementById("calltime").value.length > 50){
            msg = msg + '『聯絡時間』格式錯誤！ \n';
        }
    }
    if (document.getElementById("address").value == ''){
    }else{
        if (document.getElementById("address").value.length > 250){
            msg = msg + '『通訊地址』格式錯誤！ \n';
        }
    }
    if (msg != ''){
        alert("資料有誤\n "+ msg );
        return false;	
    }else{
        return true;
    } 

});

function chk_basedataForm(theForm){
    
    
    msg = '';
    if (theForm.cname.value == ''){
        msg = msg + '『中文姓名1』請填寫！ \n';
    }else{
        if (theForm.cname.value.length > 20){
            msg = msg + '『中文姓名』格式錯誤！ \n';
        }
    }
    if (theForm.ename.value == ''){
    }else{
        if (theForm.ename.value.length > 30){
            msg = msg + '『英文姓名』格式錯誤！ \n';
        }
    }
    if (theForm.gender.value == ''){
        msg = msg + '『性別』請選擇！ \n';
    }
    if (theForm.marital.value == ''){
        msg = msg + '『婚姻狀況』請選擇！ \n';
    }
    if (theForm.birthdayYear.value == '' || theForm.birthdayMonth.value == '' || theForm.birthdayDate.value == ''){
        msg = msg + '『出生日期』請選擇！ \n';
    }else{
        if (isExistDate(theForm.birthdayYear.value+'-'+theForm.birthdayMonth.value+'-'+theForm.birthdayDate.value)==false){
            msg = msg + '『出生日期』格式錯誤！ \n';
        }
    }  
    if (theForm.email.value == ''){
        msg = msg + '『E-mail』請填寫！ \n';
    }else{
        if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(theForm.email.value)){
            msg = msg + '『E-mail』格式錯誤！ \n';
        }
    }
    if (theForm.cellphone.value == ''){
    }else{
        if (theForm.cellphone.value.length > 20){
            msg = msg + '『聯絡電話』格式錯誤！ \n';
        }
    }
    if (theForm.calltime.value == ''){
    }else{
        if (theForm.calltime.value.length > 50){
            msg = msg + '『聯絡時間』格式錯誤！ \n';
        }
    }
    if (theForm.address.value == ''){
    }else{
        if (theForm.address.value.length > 250){
            msg = msg + '『通訊地址』格式錯誤！ \n';
        }
    }

    if (msg != ''){
        alert("資料有誤\n "+ msg );
        return false;	
    }else{
        return true;
    }   
}

function chk_educationForm(theForm){
    msg = "";
    if (theForm.school_name.value == ''){
        msg = msg + '『學校』請填寫！ \n';
    }else{
        if (theForm.school_name.value.length > 30){
            msg = msg + '『學校』格式錯誤！ \n';
        }
    }
    if (theForm.major_name.value == ''){
        msg = msg + '『科系』請填寫！ \n';
    }else{
        if (theForm.major_name.value.length > 30){
            msg = msg + '『科系』格式錯誤！ \n';
        }
    }
    if (theForm.study_datelist.value != ''){
        if (theForm.study_datelist.value.length > 50){
            msg = msg + '『期間』格式錯誤！ \n';
        }
    }
    if (theForm.study_status.value == ''){
        msg = msg + '『狀態』請選取！ \n';
    }
    if (msg != ''){
        alert("資料有誤 \n"+ msg );
        return false;	
    }else{
        return true;
    } 

}
function chk_experienceForm(theForm){
    
    msg = "";
    if (theForm.com_name.value == ''){
        msg = msg + '『公司名稱』請填寫！ \n';
    }else{
        if (theForm.com_name.value.length > 30){
            msg = msg + '『公司名稱』格式錯誤！ \n';
        }
    }
    if (theForm.job_name.value == ''){
        msg = msg + '『職務名稱』請填寫！ \n';
    }else{
        if (theForm.job_name.value.length > 30){
            msg = msg + '『職務名稱』格式錯誤！ \n';
        }
    }
    
    if (theForm.job_datelist.value != ''){
        if (theForm.job_datelist.value.length > 50){
            msg = msg + '『任職期間』格式錯誤！ \n';
        }
    }
    
    if (theForm.job_content.value != ''){
        if (theForm.job_content.value.length > 2000){
            msg = msg + '『工作內容』格式錯誤！ \n';
        }
    }
    if (msg != ''){
        alert("資料有誤 \n"+ msg );
        return false;	
    }else{
        return true;
    } 

}
function chk_skillsForm(theForm){
    
    msg = "";
    if (theForm.skill_title.value == ''){
        msg = msg + '『標題』請填寫！ \n';
    }else{
        if (theForm.skill_title.value.length > 200){
            msg = msg + '『標題』格式錯誤！ \n';
        }
    }
    
    if (theForm.skill_content.value == ''){
        if (theForm.skill_content.value.length > 1000){
            msg = msg + '『內容』格式錯誤！ \n';
        }
    }   
    if (msg != ''){
        alert("資料有誤 \n"+ msg );
        return false;	
    }else{
        return true;
    } 

}
function chk_portfolioForm(theForm){
    
    msg = "";
    if (theForm.pro_title.value == ''){
        msg = msg + '『作品名稱』請填寫！ \n';
    }else{
        if (theForm.pro_title.value.length > 200){
            msg = msg + '『作品名稱』格式錯誤！ \n';
        }
    }
    
    if (theForm.pro_content.value == ''){
        if (theForm.pro_content.value.length > 500){
            msg = msg + '『簡單說明』格式錯誤！ \n';
        }
    }   
    if (msg != ''){
        alert("資料有誤 \n"+ msg );
        return false;	
    }else{
        return true;
    } 

}

function fun_deleteData(tablen,pk){
    if(confirm('確定刪除嗎?')){
        $.post("./aj/delete.php",{tablen: tablen, pk: pk},function(res){
            //重新載入資料
            location.reload();
        })
    }   
}

function fun_changeSortData(tablen,pk,act){
    console.log(tablen);
    
    $.post("./aj/sort.php",{tablen: tablen, pk: pk, act: act},function(res){
        location.reload();
    }) 
}

$("#sub_autobiography").on("click", function(){  
    msg = "";
    if ($("input[name='datashow']").val() == ''){
        if ($("input[name='info']").val().length > 4000){
            msg = msg + '『自傳內容』格式錯誤！ \n';
        }
    }else{
        if ($("input[name='info']").val() == ''){
            msg = msg + '『自傳內容』請填寫！ \n';
        }else{
            if ($("input[name='info']").val().length > 4000){
                msg = msg + '『自傳內容』格式錯誤！ \n';
            }
        }
    }
    if (msg != ''){
        alert("資料有誤\n "+ msg );
        return false;	
    }else{
        return true;
    } 

});

$("#sub_description").on("click", function(){  
    msg = "";
    if ($("input[name='datashow']").val() == ''){
        if ($("input[name='info']").val().length > 1000){
            msg = msg + '『簡述內容』格式錯誤！ \n';
        }
    }else{
        if ($("input[name='info']").val() == ''){
            msg = msg + '『簡述內容』請填寫！ \n';
        }else{
            if ($("input[name='info']").val().length > 1000){
                msg = msg + '『簡述內容』格式錯誤！ \n';
            }
        }
    }
    if (msg != ''){
        alert("資料有誤\n "+ msg );
        return false;	
    }else{
        return true;
    } 

});
function chk_jobhuntingForm(theForm){
    
    msg = "";
    if (theForm.job_name.value == ''){
        msg = msg + '『希望職務名稱』請填寫！ \n';
    }else{
        if (theForm.job_name.value.length > 50){
            msg = msg + '『希望職務名稱』格式錯誤！ \n';
        }
    }   
    if (theForm.job_desc.value != ''){
        if (theForm.job_desc.value.length > 300){
            msg = msg + '『職務內容描述』格式錯誤！ \n';
        }
    }
    if (theForm.work_area.value != ''){
        if (theForm.work_area.value.length > 300){
            msg = msg + '『希望工作地點』格式錯誤！ \n';
        }
    }
    
    if (theForm.work_salary_kind.value == '3'){
        if (theForm.work_salary_s.value == '' && theForm.work_salary_e.value == ''){
            msg = msg + '『希望薪資待遇』薪資請填寫！ \n';
        }
    }
    if (msg != ''){
        alert("資料有誤 \n"+ msg );
        return false;	
    }else{
        return true;
    } 

}
