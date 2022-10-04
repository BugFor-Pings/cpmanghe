-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-10-04 14:23:32
-- 服务器版本： 5.6.50-log
-- PHP 版本： 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `cp_mmjl8_top`
--

-- --------------------------------------------------------

--
-- 表的结构 `mh_config`
--

CREATE TABLE `mh_config` (
  `k` varchar(255) NOT NULL,
  `v` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mh_config`
--

INSERT INTO `mh_config` (`k`, `v`) VALUES
('chouqu_money', '1'),
('daili_lirun', '50'),
('daili_lirun2', '30'),
('daili_money', '10'),
('daili_zdy', '1'),
('description', '交友盲盒'),
('epay_id', '改为自己的pid'),
('epay_key', '改为自己的key'),
('epay_url', '改成易支付地址'),
('first_toudi', '0'),
('img1', '../public/index/img/lunbo/img_fc8321dd2f117d23d6735ebf5ab7bba5.png'),
('img1_url', '#'),
('img2', '../public/index/img/lunbo/img_780625d0d442d0f46d89709f990905e7.png'),
('img2_url', '#'),
('img3', '../public/index/img/lunbo/img_25d228a0feb2e0e4aab309fe83c8270b.png'),
('img3_url', '#'),
('jifen', '0'),
('keywords', '交友盲盒'),
('kfqq', '924984'),
('kfwx', '924984'),
('manghe_shenhe', '0'),
('manghe_vip', '1'),
('name', 'admin'),
('pwd', '123456.'),
('sitename', '交友盲盒'),
('sitetime', '2022-10-04'),
('title', '交友盲盒'),
('tixian', '10'),
('toudi_money', '1'),
('user_gonggao', '网络交友需谨慎！禁止大批量参与\"抽一个\"活动，禁止微商、电销、引流等类似行业参与，一经发现永久封禁IP和号码，忘悉知！'),
('user_url', 'cp.mmjl8.top'),
('var', '1.0');

-- --------------------------------------------------------

--
-- 表的结构 `mh_manghe`
--

CREATE TABLE `mh_manghe` (
  `id` int(10) UNSIGNED NOT NULL,
  `site` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) NOT NULL,
  `sex` int(11) NOT NULL,
  `weixin` varchar(11) NOT NULL,
  `jieshao` text,
  `city` varchar(255) NOT NULL,
  `touxiang` text,
  `status` int(11) DEFAULT '1',
  `from_user` varchar(255) DEFAULT NULL,
  `for_user` varchar(255) DEFAULT NULL,
  `addtime` varchar(255) NOT NULL,
  `endtime` varchar(255) DEFAULT NULL,
  `orderid` varchar(255) NOT NULL,
  `ok` int(11) DEFAULT '0',
  `ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mh_manghe`
--

INSERT INTO `mh_manghe` (`id`, `site`, `name`, `birthday`, `sex`, `weixin`, `jieshao`, `city`, `touxiang`, `status`, `from_user`, `for_user`, `addtime`, `endtime`, `orderid`, `ok`, `ip`) VALUES
(232, NULL, '111', '2021-11-03', 1, '11', '111', '湖南湘西州', '/public/index/img/touxiang/moren.png', 1, 'b6087734f0ddbb4486ba88643316b790', NULL, '2021-11-03 19:48:12', NULL, '20211103194812925', 0, '218.76.145.198'),
(233, NULL, 'asda', '2021-11-09', 1, '0', 'ada', '上海长宁区', '/public/index/img/touxiang/moren.png', 1, '79645f4e4d0d89b7900a7c923258efa6', NULL, '2021-11-06 17:34:34', NULL, '20211106173434680', 0, '123.149.41.187'),
(234, NULL, 'Hacker', '2021-11-06', 1, '0', '1111111111111', '湖南', '/public/index/img/touxiang/moren.png', 1, '63ccbfe048e6e1ec3274c584ca3bc17f', NULL, '2021-11-06 21:52:26', NULL, '20211106215226423', 0, '117.136.89.43'),
(235, NULL, 'Hacker', '2021-11-06', 1, '0', '111111111111', '湖南', '/public/index/img/touxiang/moren.png', 1, 'admin', NULL, '2021-11-06 21:54:04', NULL, '20211106215404933', 1, '117.136.89.43'),
(236, NULL, 'root', '2021-11-18', 1, '0', 'admin', '吉林', '/public/index/img/touxiang/moren.png', 1, 'admin', 'Pings', '2021-11-06 22:06:04', '2022-10-04 12:44:31', '20211106220604316', 1, '112.193.144.55'),
(237, NULL, '张三', '2021-11-06', 1, '2147483647', '1111', '广东', '/public/index/img/touxiang/moren.png', 1, 'admin', NULL, '2021-11-06 22:09:01', NULL, '20211106220901496', 1, '117.136.89.43'),
(238, NULL, '111', '2021-11-01', 1, '0', '8561+23', '河南', '/public/index/img/touxiang/moren.png', 1, 'admin', NULL, '2021-11-06 22:11:09', NULL, '20211106221109419', 1, '117.136.89.43'),
(239, NULL, '赴月', '2021-11-02', 1, '0', '1111', '内蒙古', '/public/index/img/touxiang/moren.png', 1, 'admin', NULL, '2021-11-06 22:12:47', NULL, '20211106221247307', 1, '117.136.89.43'),
(240, NULL, '赴月', '2021-11-02', 1, '2147483647', '1111', '湖南', '/public/index/img/touxiang/moren.png', 1, 'admin', NULL, '2021-11-06 22:13:10', NULL, '20211106221310570', 1, '117.136.89.43'),
(241, NULL, '111121312', '2021-11-09', 1, '2147483647', '发的交货期为人妻', '福建龙岩市', '/public/index/img/touxiang/moren.png', 1, 'admin', NULL, '2021-11-06 22:13:59', NULL, '20211106221359529', 1, '117.136.89.43'),
(242, NULL, 'test', '2022-10-13', 1, '123', 'test123', '四川成都市', '/public/index/img/touxiang/moren.png', 1, 'Pings', NULL, '2022-10-04 12:39:19', NULL, '20221004123919466', 1, '112.193.144.55'),
(243, NULL, 'test', '2022-10-13', 1, '0', 'test123', '四川成都市', '/public/index/img/touxiang/moren.png', 1, 'Pings', NULL, '2022-10-04 12:42:49', NULL, '20221004124249773', 1, '112.193.144.55'),
(244, NULL, '测试', '2015-09-15', 1, '0', '测试投递', '四川成都市', '/public/index/img/touxiang/moren.png', 1, 'Pings', NULL, '2022-10-04 12:43:27', NULL, '20221004124327749', 1, '112.193.144.55'),
(245, NULL, 'test', '2022-10-13', 1, '0', 'test123', '四川成都市', '/public/index/img/touxiang/moren.png', 1, 'Pings', NULL, '2022-10-04 12:45:44', NULL, '20221004124544533', 1, '112.193.144.55'),
(246, NULL, 'test', '2022-10-13', 1, '123456', 'test123', '四川成都市', '/public/index/img/touxiang/moren.png', 1, 'Pings', NULL, '2022-10-04 13:03:00', NULL, '20221004130259815', 1, '112.193.144.55'),
(247, NULL, 'test', '2022-10-13', 1, '0', 'test123', '四川成都市', '/public/index/img/touxiang/moren.png', 1, 'Pings', NULL, '2022-10-04 13:06:08', NULL, '20221004130608342', 1, '112.193.144.55'),
(248, NULL, 'test', '2022-10-13', 1, 'admin123', 'test123', '四川成都市', '/public/index/img/touxiang/moren.png', 1, 'Pings', NULL, '2022-10-04 13:07:06', NULL, '20221004130706663', 1, '112.193.144.55');

-- --------------------------------------------------------

--
-- 表的结构 `mh_pay`
--

CREATE TABLE `mh_pay` (
  `id` int(11) UNSIGNED NOT NULL,
  `orderno` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `addtime` varchar(255) NOT NULL,
  `endtime` varchar(255) DEFAULT NULL,
  `money` decimal(12,2) NOT NULL,
  `status` int(11) NOT NULL,
  `bz` text NOT NULL,
  `chouqu` varchar(255) DEFAULT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mh_pay`
--

INSERT INTO `mh_pay` (`id`, `orderno`, `name`, `addtime`, `endtime`, `money`, `status`, `bz`, `chouqu`, `user`) VALUES
(258, '20211103194812925', '', '2021-11-03 19:48:13', NULL, '1.00', 0, '投递盲盒', 'false', 'b6087734f0ddbb4486ba88643316b790'),
(259, '20211104005419527', '', '2021-11-04 00:54:24', NULL, '111.00', 0, '用户充值', 'false', 'qwert'),
(260, '20211104005419527', '', '2021-11-04 00:54:39', NULL, '40.00', 0, '用户充值', 'false', 'qwert'),
(261, '20211104005419527', '', '2021-11-04 00:54:51', NULL, '1.00', 0, '用户充值', 'false', 'qwert'),
(262, '20211104005507864', '', '2021-11-04 00:55:11', NULL, '11.00', 0, '用户充值', 'false', 'qwert'),
(263, '20211106173434680', '', '2021-11-06 17:34:34', NULL, '1.00', 0, '投递盲盒', 'false', '79645f4e4d0d89b7900a7c923258efa6'),
(264, '20211106215226423', '', '2021-11-06 21:52:26', NULL, '1.00', 0, '投递盲盒', 'false', '63ccbfe048e6e1ec3274c584ca3bc17f'),
(265, '20211106215404933', '', '2021-11-06 21:54:05', NULL, '1.00', 1, '投递盲盒', 'false', 'admin'),
(266, '20211106220604316', '', '2021-11-06 22:06:04', NULL, '1.00', 1, '投递盲盒', 'false', 'admin'),
(267, '20211106220901496', '', '2021-11-06 22:09:01', NULL, '1.00', 1, '投递盲盒', 'false', 'admin'),
(268, '20211106221109419', '', '2021-11-06 22:11:09', NULL, '1.00', 1, '投递盲盒', 'false', 'admin'),
(269, '20211106221247307', '', '2021-11-06 22:12:47', NULL, '1.00', 1, '投递盲盒', 'false', 'admin'),
(270, '20211106221310570', '', '2021-11-06 22:13:10', NULL, '1.00', 1, '投递盲盒', 'false', 'admin'),
(271, '20211106221359529', '', '2021-11-06 22:14:00', NULL, '1.00', 1, '投递盲盒', 'false', 'admin'),
(272, '20220111050121812', '', '2022-01-11 05:01:26', NULL, '1.00', 0, '用户充值', 'false', '68824454'),
(273, '20221004123349507', '', '2022-10-04 12:33:55', NULL, '1.00', 0, '抽取盲盒', 'nan', 'Pings'),
(274, '20221004123349507', '', '2022-10-04 12:36:15', NULL, '1.00', 0, '抽取盲盒', 'nan', 'Pings'),
(275, '20221004123349507', '', '2022-10-04 12:36:19', NULL, '1.00', 0, '抽取盲盒', 'nan', 'Pings'),
(276, '20221004123919466', '', '2022-10-04 12:39:20', NULL, '1.00', 1, '投递盲盒', 'false', 'Pings'),
(277, '20221004124249773', '', '2022-10-04 12:42:49', NULL, '1.00', 1, '投递盲盒', 'false', 'Pings'),
(278, '20221004124327749', '', '2022-10-04 12:43:27', NULL, '1.00', 1, '投递盲盒', 'false', 'Pings'),
(279, '20221004124425811', '', '2022-10-04 12:44:29', NULL, '1.00', 1, '抽取盲盒', 'nan', 'Pings'),
(280, '20221004124544533', '', '2022-10-04 12:45:44', NULL, '1.00', 1, '投递盲盒', 'false', 'Pings'),
(281, '20221004130259815', '', '2022-10-04 13:03:00', NULL, '1.00', 1, '投递盲盒', 'false', 'Pings'),
(282, '20221004130608342', '', '2022-10-04 13:06:08', NULL, '1.00', 1, '投递盲盒', 'false', 'Pings'),
(283, '20221004130706663', '', '2022-10-04 13:07:06', NULL, '1.00', 1, '投递盲盒', 'false', 'Pings');

-- --------------------------------------------------------

--
-- 表的结构 `mh_point`
--

CREATE TABLE `mh_point` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `money` decimal(12,2) NOT NULL,
  `type` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `addtime` varchar(255) NOT NULL,
  `orderid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mh_point`
--

INSERT INTO `mh_point` (`id`, `user`, `money`, `type`, `content`, `addtime`, `orderid`) VALUES
(1, 'admin', '1.00', '减少', '投递盲盒', '2021-11-06 21:54:06', ''),
(2, 'admin', '1.00', '减少', '投递盲盒', '2021-11-06 22:06:05', ''),
(3, 'admin', '1.00', '减少', '投递盲盒', '2021-11-06 22:09:02', ''),
(4, 'admin', '1.00', '减少', '投递盲盒', '2021-11-06 22:11:11', ''),
(5, 'admin', '1.00', '减少', '投递盲盒', '2021-11-06 22:12:48', ''),
(6, 'admin', '1.00', '减少', '投递盲盒', '2021-11-06 22:13:11', ''),
(7, 'admin', '1.00', '减少', '投递盲盒', '2021-11-06 22:14:01', ''),
(8, 'Pings', '1.00', '减少', '投递盲盒', '2022-10-04 12:39:21', ''),
(9, 'Pings', '1.00', '减少', '投递盲盒', '2022-10-04 12:42:50', ''),
(10, 'Pings', '1.00', '减少', '投递盲盒', '2022-10-04 12:43:28', ''),
(11, 'Pings', '1.00', '减少', '抽取盲盒', '2022-10-04 12:44:30', '20221004124425811'),
(12, 'Pings', '1.00', '减少', '投递盲盒', '2022-10-04 12:45:45', ''),
(13, 'Pings', '1.00', '减少', '投递盲盒', '2022-10-04 13:03:01', ''),
(14, 'Pings', '1.00', '减少', '投递盲盒', '2022-10-04 13:06:09', ''),
(15, 'Pings', '1.00', '减少', '投递盲盒', '2022-10-04 13:07:07', '');

-- --------------------------------------------------------

--
-- 表的结构 `mh_site`
--

CREATE TABLE `mh_site` (
  `id` int(11) NOT NULL,
  `type` int(1) DEFAULT '1',
  `url` varchar(255) DEFAULT NULL,
  `sitename` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `kfwx` varchar(255) NOT NULL,
  `kfqq` varchar(255) NOT NULL,
  `toudi` decimal(12,2) DEFAULT '1.00',
  `chouqu` decimal(12,2) DEFAULT '1.00',
  `daili` decimal(12,2) DEFAULT '1.00',
  `addtime` varchar(255) NOT NULL,
  `tx_zh` varchar(255) DEFAULT NULL,
  `tx_xm` varchar(255) DEFAULT NULL,
  `tx_skt` varchar(255) DEFAULT NULL,
  `tx_type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mh_site`
--

INSERT INTO `mh_site` (`id`, `type`, `url`, `sitename`, `title`, `description`, `keywords`, `kfwx`, `kfqq`, `toudi`, `chouqu`, `daili`, `addtime`, `tx_zh`, `tx_xm`, `tx_skt`, `tx_type`, `status`, `user`) VALUES
(1, 2, '9yskof5.mmjl8.top', 'baidu.com', '', 'awvs', '外链网盘,免费外链,免费图床,图片外链,顾词图床,图床,微博图床,网络图片,图片库,相册,网络相册,外链,图片外链,外链相册,淘宝图片,论坛图片,贴图', '', '', '1.00', '1.00', '1.00', '2022-10-04 13:07:36', NULL, NULL, NULL, NULL, 1, 'Pings');

-- --------------------------------------------------------

--
-- 表的结构 `mh_tixian`
--

CREATE TABLE `mh_tixian` (
  `id` int(10) UNSIGNED NOT NULL,
  `money` decimal(12,2) NOT NULL,
  `addtime` varchar(255) NOT NULL,
  `endtime` varchar(255) DEFAULT NULL,
  `user` int(11) NOT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mh_user`
--

CREATE TABLE `mh_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `site` varchar(255) DEFAULT NULL COMMENT '分站',
  `upsite` int(11) NOT NULL COMMENT '上级站点',
  `user` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `rmb` decimal(12,2) DEFAULT '0.00',
  `jifen` varchar(255) DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `weixin` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `jieshao` text,
  `touxiang` text,
  `addtime` varchar(255) NOT NULL,
  `viptime` varchar(255) DEFAULT NULL,
  `dltime` varchar(255) DEFAULT NULL,
  `qdtime` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mh_user`
--

INSERT INTO `mh_user` (`id`, `site`, `upsite`, `user`, `pwd`, `rmb`, `jifen`, `name`, `sex`, `age`, `birthday`, `weixin`, `city`, `jieshao`, `touxiang`, `addtime`, `viptime`, `dltime`, `qdtime`, `status`) VALUES
(35, NULL, 0, '123', '123', '0.00', '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '2021-10-20 23:43:28', 1),
(36, NULL, 0, 'qwert', '123456', '0.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 1),
(37, NULL, 0, 'admin', '123456', '9992.00', '0', NULL, 1, NULL, '2021-11-06', '1', '1', '1111', '/public/index/img/touxiang/moren.png', '', NULL, NULL, NULL, 1),
(38, NULL, 0, '68824454', 'Ks586396', '0.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '2022-01-11 05:06:53', 1),
(39, NULL, 0, 'Pings', 'Pings1031.', '971.00', '0', 'test', 1, NULL, '2022-10-13', 'admin123', '四川成都市', 'test123', '/public/index/img/touxiang/moren.png', '', NULL, '2099-09-22', '2022-10-04 13:03:16', 1),
(40, NULL, 0, 'aaa', 'aaa', '0.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '2022-10-04 13:26:58', 1);

--
-- 转储表的索引
--

--
-- 表的索引 `mh_config`
--
ALTER TABLE `mh_config`
  ADD PRIMARY KEY (`k`);

--
-- 表的索引 `mh_manghe`
--
ALTER TABLE `mh_manghe`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `mh_pay`
--
ALTER TABLE `mh_pay`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `mh_point`
--
ALTER TABLE `mh_point`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `mh_site`
--
ALTER TABLE `mh_site`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `mh_tixian`
--
ALTER TABLE `mh_tixian`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `mh_user`
--
ALTER TABLE `mh_user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `mh_manghe`
--
ALTER TABLE `mh_manghe`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- 使用表AUTO_INCREMENT `mh_pay`
--
ALTER TABLE `mh_pay`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;

--
-- 使用表AUTO_INCREMENT `mh_point`
--
ALTER TABLE `mh_point`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `mh_site`
--
ALTER TABLE `mh_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `mh_tixian`
--
ALTER TABLE `mh_tixian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mh_user`
--
ALTER TABLE `mh_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
