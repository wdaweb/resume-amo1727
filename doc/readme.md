# 作業-個人履歷系統

## 作品集計畫 
工作期間所做的各類網站

## 視覺計畫
極簡風格

## 功能規劃
    全站RWD，內容有以下區塊
    * 基本資料
    * 學經歷
    * 技能
    * 簡述
    * 自傳
    * 作品集
    * 求職條件

### 前台畫面
![](https://i.imgur.com/OBXr54w.jpg)


### 後台畫面
1. 使用者登入頁(adm/index.php)
     * 輸入驗證碼

![](https://i.imgur.com/SpIlGG0.jpg)

2. 登入後首頁-履歷管理(adm/manage.php)
    * 履歷(增、刪、是否開啟)

![](https://i.imgur.com/9vTdrTp.jpg)

3. 基本資料(adm/basedata.php)
    * 修改資料
    * 可上傳個人相片

![](https://i.imgur.com/YnP0NgA.jpg)

4. 學經歷(adm/experience.php)
    * 學歷(增、修、刪、排序、是否顯示)
    * 經歷(增、修、刪、排序、是否顯示)

![](https://i.imgur.com/zkjkcqh.jpg)

5. 技能(adm/skills.php)
    * 增、修、刪、排序、是否顯示

![](https://i.imgur.com/dbaVjpb.jpg)

6. 簡述(adm/description.php)
    * 修改、是否顯示

![](https://i.imgur.com/WaBAnL7.jpg)

7. 自傳(adm/autobiography.php)
    * 修改、是否顯示

![](https://i.imgur.com/FwUQbQF.jpg)

8. 作品集(adm/portfolio.php)
    * 增、修、刪、排序、是否顯示

![](https://i.imgur.com/pDQLEXS.jpg)
    
9. 求職條件(adm/jobhunting.php)
    * 修改

![](https://i.imgur.com/t4rq6mp.jpg)


## 資料庫規劃
DB(dbresume)
1. 使用者資料(user)
    * pk
    * acc 帳號 
    * pw 密碼 
    * name 暱稱 
    * enable 是否啟用 
    * credit_time 資料建立時間
    * modify_time 資料最後修改時間
2. 履歷(resume)
    * pk
    * user_pk 使用者pk 
    * resume_name 履歷名
    * resume_status 履歷狀態
    * credit_time 資料建立時間
    * modify_time 資料最後修改時間
2. 基本資料(basedata)
    * pk
    * user_pk 使用者pk
    * resume_pk 履歷pk
    * cname 中文姓名 
    * ename 英文姓名 
    * gender 性別
    * marital 婚姻狀況
    * birthday 出生日期
    * email E-mail
    * call_phone 聯絡電話
    * call_time 聯絡時間
    * address 通訊地址
    * pic_name 相片名稱
    * pic_type 相片格式
    * pic_show 相片顯示
    * credit_time 資料建立時間
    * modify_time 資料最後修改時間
3. 學歷(education)
    * pk
    * user_pk 使用者pk
    * resume_pk 履歷pk
    * datashow 顯示
    * school_name 學校
    * major_name 科系
    * study_datelist 期間
    * study_status 狀態 
    * sort 排序 
    * credit_time 資料建立時間
    * modify_time 資料最後修改時間
4. 經歷(experience)
    * pk
    * user_pk 使用者pk
    * resume_pk 履歷pk
    * datashow 顯示
    * com_name 公司名稱
    * job_name 職務名稱
    * job_datelist 期間
    * job_status 狀態 
    * job_content 工作內容 
    * sort 排序
    * credit_time 資料建立時間
    * modify_time 資料最後修改時間
5. 技能(skills)
    * pk
    * user_pk 使用者pk
    * resume_pk 履歷pk
    * datashow 顯示
    * skill_title 技能標題
    * skill_content 技能內容 
    * sort 排序
    * credit_time 資料建立時間
    * modify_time 資料最後修改時間
6. 簡述(description)
    * pk
    * user_pk 使用者pk
    * resume_pk 履歷pk
    * datashow 顯示
    * info 簡述內容
    * credit_time 資料建立時間
    * modify_time 資料最後修改時間
7. 自傳(autobiography)
    * pk
    * user_pk 使用者pk
    * resume_pk 履歷pk
    * datashow 顯示
    * info 自傳內容
    * credit_time 資料建立時間
    * modify_time 資料最後修改時間
8. 作品集(portfolio)
    * pk
    * user_pk 使用者pk
    * resume_pk 履歷pk
    * datashow 顯示
    * pro_title 作品名稱
    * pro_content 簡單說明 
    * pic_name 相片名稱
    * pic_type 相片格式
    * pic_show 相片顯示
    * sort 排序
    * credit_time 資料建立時間
    * modify_time 資料最後修改時間
9. 求職條件(jobhunting)
    * pk
    * user_pk 使用者pk
    * resume_pk 履歷pk
    * job_name 希望職務名稱
    * job_desc 職務內容描述 
    * work_area 希望工作地點
    * work_salary_kind 希望薪資待遇("":不顯示)(1:面議)(2:依公司規定)(3:指定)
    * work_salary_s 希望薪資待遇(開始)
    * work_salary_e 希望薪資待遇(結束)
    * credit_time 資料建立時間
    * modify_time 資料最後修改時間