-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.6-MariaDB
-- PHP 版本： 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `dbresume`
--

-- --------------------------------------------------------

--
-- 資料表結構 `autobiography`
--

CREATE TABLE `autobiography` (
  `pk` int(10) UNSIGNED NOT NULL,
  `user_pk` int(11) NOT NULL,
  `resume_pk` int(11) NOT NULL,
  `info` varchar(4000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datashow` tinyint(4) NOT NULL,
  `credit_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `autobiography`
--

INSERT INTO `autobiography` (`pk`, `user_pk`, `resume_pk`, `info`, `datashow`, `credit_time`, `modify_time`) VALUES
(1, 1, 1, '孫鵬、狄鶯獨子孫安佐與同為YouTuber的網紅米砂(Misa)，從合作拍片傳緋聞到爆出墮胎風波，孫安佐則在上週拍片反擊，嘆自己被「黑」，說出「我不想知道妳為誰墮胎」，還要女方「去看醫生或吃藥」，正宮阿乃隨後接力，接連發文怒揭米砂追愛孫安佐不成假自殘吸引男方注意，並傳私訊挑釁她，還痛批米砂墮胎聲明文開營利大賺一筆，米砂昨天則透過經紀人發千字文駁斥炒作說法，三方互攻越演越烈，鬧得孫鵬也罕見打破低調不回應態度，罕見在臉書po文說出真心話。\r\n孫安佐、米砂「墮胎風波」越鬧越激烈，連正宮阿乃都加入戰局，惹得孫鵬也難以保持沉默，他24日突然在臉書貼出一張勵志小語圖片，標題寫著：「何須解釋，心安就好」，內容則是寫道「活在這個世上，有人喜歡你，就有人討厭你，有人信任你，就有人懷疑你，無論別人怎麼看你，都無需在意，好好做自己」。\r\n\r\n而除了貼出勵志小語，孫鵬也在留言處寫下「謝謝各位支持」並附上笑臉符號，加上他上一次po文已經是9月初的事情，更讓人覺得現在這篇勵志文相當罕見，出現時機也很巧妙，不得不把文章想做是孫鵬近期的真心話，以及對兒子孫安佐的支持，而網友看了，也可以理解他的想法，表示「爸爸不好當，我相信你盡力了」、「鵬哥是對的」，但也忍不住說實話「不過討厭你兒子的好像比較多」。', 0, '2019-11-27 08:07:07', '2019-12-07 02:02:04');

-- --------------------------------------------------------

--
-- 資料表結構 `basedata`
--

CREATE TABLE `basedata` (
  `pk` int(10) UNSIGNED NOT NULL,
  `user_pk` int(11) NOT NULL,
  `resume_pk` int(11) NOT NULL,
  `cname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ename` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `marital` tinyint(1) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_time` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic_show` tinyint(1) NOT NULL,
  `credit_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `basedata`
--

INSERT INTO `basedata` (`pk`, `user_pk`, `resume_pk`, `cname`, `ename`, `gender`, `marital`, `birthday`, `email`, `call_phone`, `call_time`, `address`, `pic_name`, `pic_type`, `pic_show`, `credit_time`, `modify_time`) VALUES
(1, 1, 1, '羅義學', '', 1, 1, '1973-12-13', 'am1o11131727@gmail.com', '0938134249', 'PM6:00~PM9:00', '', 'a13dae8e26de92539509eb805234a7bd', 'jpg', 1, '2019-11-22 07:39:24', '2019-12-07 01:55:14');

-- --------------------------------------------------------

--
-- 資料表結構 `description`
--

CREATE TABLE `description` (
  `pk` int(10) UNSIGNED NOT NULL,
  `user_pk` int(11) NOT NULL,
  `resume_pk` int(11) NOT NULL,
  `info` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datashow` tinyint(4) NOT NULL,
  `credit_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `description`
--

INSERT INTO `description` (`pk`, `user_pk`, `resume_pk`, `info`, `datashow`, `credit_time`, `modify_time`) VALUES
(1, 1, 1, '喜歡寫程式，喜歡嘗試新東西，喜歡研究挑戰找出最直接與有效的寫法， \r\n遇到難題時讓自己保持不同角度的思考方式，因此這路上我學習到了很多，也會繼續學習下去。 \r\n不管在哪個職場生涯，我只求自己的表現能夠盡善盡美，使命必達，帶給公司更多貢獻並共同成長。', 1, '2019-11-27 08:17:05', '2019-12-07 01:49:00');

-- --------------------------------------------------------

--
-- 資料表結構 `education`
--

CREATE TABLE `education` (
  `pk` int(10) UNSIGNED NOT NULL,
  `user_pk` int(11) NOT NULL,
  `resume_pk` int(11) NOT NULL,
  `school_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `major_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `study_datelist` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `study_status` tinyint(1) NOT NULL,
  `datashow` tinyint(4) NOT NULL,
  `sort` int(11) NOT NULL,
  `credit_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `education`
--

INSERT INTO `education` (`pk`, `user_pk`, `resume_pk`, `school_name`, `major_name`, `study_datelist`, `study_status`, `datashow`, `sort`, `credit_time`, `modify_time`) VALUES
(7, 1, 1, '新埔工專', '電子工程科', '1989／09～1994／06', 1, 1, 8, '2019-11-25 08:18:33', '2019-12-06 22:47:02'),
(8, 1, 1, '國立臺北科技大學', '工業工程系', '1998／09～2001／07', 1, 1, 7, '2019-11-25 08:20:01', '2019-12-06 22:46:24');

-- --------------------------------------------------------

--
-- 資料表結構 `experience`
--

CREATE TABLE `experience` (
  `pk` int(10) UNSIGNED NOT NULL,
  `user_pk` int(11) NOT NULL,
  `resume_pk` int(11) NOT NULL,
  `com_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_datelist` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_status` tinyint(1) NOT NULL,
  `job_content` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datashow` tinyint(4) NOT NULL,
  `sort` int(11) NOT NULL,
  `credit_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `experience`
--

INSERT INTO `experience` (`pk`, `user_pk`, `resume_pk`, `com_name`, `job_name`, `job_datelist`, `job_status`, `job_content`, `datashow`, `sort`, `credit_time`, `modify_time`) VALUES
(2, 1, 1, '締峯科技股份有限公司', '資深工程師', '2009／02～2019／07', 0, '', 1, 2, '2019-11-27 07:51:20', '2019-12-06 22:48:08');

-- --------------------------------------------------------

--
-- 資料表結構 `jobhunting`
--

CREATE TABLE `jobhunting` (
  `pk` int(10) UNSIGNED NOT NULL,
  `user_pk` int(11) NOT NULL,
  `resume_pk` int(11) NOT NULL,
  `job_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_desc` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_area` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_salary_kind` tinyint(4) NOT NULL DEFAULT 0,
  `work_salary_s` int(11) DEFAULT NULL,
  `work_salary_e` int(11) DEFAULT NULL,
  `credit_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `jobhunting`
--

INSERT INTO `jobhunting` (`pk`, `user_pk`, `resume_pk`, `job_name`, `job_desc`, `work_area`, `work_salary_kind`, `work_salary_s`, `work_salary_e`, `credit_time`, `modify_time`) VALUES
(1, 1, 1, 'Internet程式設計師', '站架構規劃與管理、網頁程式設計、系統分析、專案管理', '台北市', 0, NULL, NULL, '2019-12-07 09:07:18', '2019-12-07 02:14:41');

-- --------------------------------------------------------

--
-- 資料表結構 `portfolio`
--

CREATE TABLE `portfolio` (
  `pk` int(10) UNSIGNED NOT NULL,
  `user_pk` int(11) NOT NULL,
  `resume_pk` int(11) NOT NULL,
  `pro_title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pro_content` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pro_link` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic_show` tinyint(4) NOT NULL DEFAULT 1,
  `datashow` tinyint(4) NOT NULL DEFAULT 1,
  `sort` int(11) NOT NULL,
  `credit_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `portfolio`
--

INSERT INTO `portfolio` (`pk`, `user_pk`, `resume_pk`, `pro_title`, `pro_content`, `pro_link`, `pic_name`, `pic_type`, `pic_show`, `datashow`, `sort`, `credit_time`, `modify_time`) VALUES
(1, 1, 1, 'TravelKing旅遊王', '利用 ASP、CSS、HTML、MSSQL、...等相關技術開發。\r\n負責前後台所有功能與維護、資料庫規劃。\r\n\r\nWEB功能如下：&amp;nbsp;\r\n旅遊資訊內容與管理\r\n網站googleAD廣告佈置\r\n會員系統\r\n新聞發佈系統\r\ngoogle map api', NULL, '3f1e847061f230f2e6f16deffb9e8d3a', 'jpg', 1, 1, 1, '2019-11-30 17:42:31', '2019-12-07 01:58:23'),
(2, 1, 1, '台北諾富特航桃園機場飯店', '利用 ASP、CSS、HTML、MSSQL、...等相關技術開發。\r\n負責前後台所有功能與維護、資料庫規劃。\r\n\r\nWEB功能如下：&amp;nbsp;\r\n網站內容與管理\r\n會員系統\r\n新聞系統\r\n線上購物系統', NULL, 'c94888a5111669298f657a1afe4ab0ca', 'jpg', 1, 1, 2, '2019-11-30 17:46:51', '2019-12-07 02:00:26');

-- --------------------------------------------------------

--
-- 資料表結構 `resume`
--

CREATE TABLE `resume` (
  `pk` int(10) UNSIGNED NOT NULL,
  `user_pk` int(11) NOT NULL,
  `resume_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume_status` tinyint(1) NOT NULL,
  `credit_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `resume`
--

INSERT INTO `resume` (`pk`, `user_pk`, `resume_name`, `resume_status`, `credit_time`, `modify_time`) VALUES
(1, 1, '測試1', 1, '2019-11-18 06:07:34', '2019-11-17 18:24:36');

-- --------------------------------------------------------

--
-- 資料表結構 `skills`
--

CREATE TABLE `skills` (
  `pk` int(10) UNSIGNED NOT NULL,
  `user_pk` int(11) NOT NULL,
  `resume_pk` int(11) NOT NULL,
  `skill_title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skill_content` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datashow` tinyint(4) NOT NULL,
  `sort` int(11) NOT NULL,
  `credit_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `skills`
--

INSERT INTO `skills` (`pk`, `user_pk`, `resume_pk`, `skill_title`, `skill_content`, `datashow`, `sort`, `credit_time`, `modify_time`) VALUES
(1, 1, 1, '後端', 'ASP\r\nPHP\r\nMS SQL\r\nMySQL', 1, 2, '2019-11-27 08:39:00', '2019-12-06 22:53:47'),
(2, 1, 1, '前端', 'HTML / CSS\r\nBootstrap\r\nJavaScript / Jquery\r\nAJAX &amp; API 串接', 1, 1, '2019-11-30 16:23:20', '2019-12-06 22:51:31'),
(3, 1, 1, '其他', 'Git / GitHub\r\nphotoshop / Illustrator\r\nFacebook API\r\nGoogle Map API\r\nSEO', 1, 3, '2019-12-07 05:56:36', '2019-12-07 01:50:15');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `pk` int(10) UNSIGNED NOT NULL,
  `acc` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pw` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enable` tinyint(1) NOT NULL DEFAULT 1,
  `credit_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`pk`, `acc`, `pw`, `name`, `enable`, `credit_time`, `modify_time`) VALUES
(1, '1727', '1727', '羅', 1, '2019-11-18 06:00:40', '2019-11-18 06:00:40');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `autobiography`
--
ALTER TABLE `autobiography`
  ADD PRIMARY KEY (`pk`);

--
-- 資料表索引 `basedata`
--
ALTER TABLE `basedata`
  ADD PRIMARY KEY (`pk`);

--
-- 資料表索引 `description`
--
ALTER TABLE `description`
  ADD PRIMARY KEY (`pk`);

--
-- 資料表索引 `education`
--
ALTER TABLE `education`
  ADD UNIQUE KEY `pk` (`pk`);

--
-- 資料表索引 `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`pk`);

--
-- 資料表索引 `jobhunting`
--
ALTER TABLE `jobhunting`
  ADD PRIMARY KEY (`pk`);

--
-- 資料表索引 `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`pk`);

--
-- 資料表索引 `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`pk`);

--
-- 資料表索引 `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`pk`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`pk`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `autobiography`
--
ALTER TABLE `autobiography`
  MODIFY `pk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `basedata`
--
ALTER TABLE `basedata`
  MODIFY `pk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `description`
--
ALTER TABLE `description`
  MODIFY `pk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `education`
--
ALTER TABLE `education`
  MODIFY `pk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `experience`
--
ALTER TABLE `experience`
  MODIFY `pk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `jobhunting`
--
ALTER TABLE `jobhunting`
  MODIFY `pk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `pk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `resume`
--
ALTER TABLE `resume`
  MODIFY `pk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `skills`
--
ALTER TABLE `skills`
  MODIFY `pk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `pk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
