-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2011 年 10 月 14 日 12:18
-- 服务器版本: 5.5.8
-- PHP 版本: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `orgWeshuo`
--

-- --------------------------------------------------------

--
-- 表的结构 `ws_aboutme`
--

CREATE TABLE IF NOT EXISTS `ws_aboutMe` (
  `aboutId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `topicId` int(10) unsigned NOT NULL,
  `time` int(10) NOT NULL,
  `userId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`aboutId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `ws_aboutme`
--

-- --------------------------------------------------------

--
-- 表的结构 `ws_attachment`
--

CREATE TABLE IF NOT EXISTS `ws_attachment` (
  `attId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fileName` varchar(20) DEFAULT NULL,
  `topicId` int(10) unsigned DEFAULT NULL,
  `desc` varchar(100) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT '0',
  `time` int(10) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `userId` int(10) DEFAULT NULL,
  `md5` varchar(32) DEFAULT NULL,
  `fileType` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`attId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=232 ;

--
-- 转存表中的数据 `ws_attachment`
--

-- --------------------------------------------------------

--
-- 表的结构 `ws_attention`
--

CREATE TABLE IF NOT EXISTS `ws_attention` (
  `attenId` int(10) NOT NULL AUTO_INCREMENT,
  `userId` int(10) NOT NULL,
  `objUser` int(10) NOT NULL,
  `actionTime` int(10) NOT NULL,
  PRIMARY KEY (`attenId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2182 ;

--
-- 转存表中的数据 `ws_attention`
--


-- --------------------------------------------------------

--
-- 表的结构 `ws_comment`
--

CREATE TABLE IF NOT EXISTS `ws_comment` (
  `commentId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL,
  `content` varchar(255) NOT NULL,
  `topicId` int(10) unsigned NOT NULL,
  `parentId` int(10) unsigned NOT NULL,
  `time` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `home` varchar(30) DEFAULT NULL,
  `address` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`commentId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=907 ;

--
-- 转存表中的数据 `ws_comment`
--

-- --------------------------------------------------------

--
-- 表的结构 `ws_favorites`
--

CREATE TABLE IF NOT EXISTS `ws_favorites` (
  `favId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL,
  `topicId` int(10) unsigned NOT NULL,
  `time` int(10) NOT NULL,
  `favType` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`favId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `ws_favorites`
--

-- --------------------------------------------------------

--
-- 表的结构 `ws_group`
--

CREATE TABLE IF NOT EXISTS `ws_group` (
  `groupId` int(10) NOT NULL AUTO_INCREMENT,
  `groupName` varchar(100) NOT NULL,
  `parentId` int(10) NOT NULL,
  `userId` int(10) NOT NULL,
  `sort` int(10) NOT NULL DEFAULT '0',
  `icon` varchar(30) NOT NULL,
  `time` int(10) NOT NULL,
  `memo` varchar(100) NOT NULL,
  `url` varchar(20) NOT NULL,
  `groupType` int(10) NOT NULL,
  `isShow` tinyint(1) NOT NULL DEFAULT '1',
  `isSend` tinyint(1) NOT NULL DEFAULT '1',
  `isReplay` tinyint(1) NOT NULL DEFAULT '1',
  `isJoin` tinyint(1) NOT NULL DEFAULT '1',
  `count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `ws_group`
--

-- --------------------------------------------------------

--
-- 表的结构 `ws_grouptype`
--

CREATE TABLE IF NOT EXISTS `ws_groupType` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  `sort` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `ws_grouptype`
--

INSERT INTO `ws_groupType` (`id`, `name`, `sort`) VALUES
(4, '官方群组', 10),
(5, '生活', 0),
(6, '娱乐', 0),
(7, '游戏', 0),
(8, '技术', 0),
(9, '无聊', 0),
(10, '其他', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ws_invite`
--

CREATE TABLE IF NOT EXISTS `ws_invite` (
  `inviteId` int(10) NOT NULL AUTO_INCREMENT,
  `userId` int(10) NOT NULL,
  `time` int(10) NOT NULL,
  `code` varchar(17) NOT NULL,
  `isUse` tinyint(1) NOT NULL,
  PRIMARY KEY (`inviteId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `ws_invite`
--


-- --------------------------------------------------------

--
-- 表的结构 `ws_link`
--

CREATE TABLE IF NOT EXISTS `ws_link` (
  `linkId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `url` varchar(120) NOT NULL,
  `sort` int(5) unsigned NOT NULL,
  `linkTypes` tinyint(1) NOT NULL,
  `pic` varchar(30) NOT NULL,
  PRIMARY KEY (`linkId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `ws_link`
--


--
-- 表的结构 `ws_message`
--

CREATE TABLE IF NOT EXISTS `ws_message` (
  `msgId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `send` int(10) NOT NULL,
  `receive` int(10) NOT NULL,
  `sendStatus` tinyint(1) NOT NULL DEFAULT '0',
  `receiveStatus` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(300) NOT NULL,
  `time` int(10) NOT NULL,
  `parentId` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`msgId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=398 ;

--
-- 转存表中的数据 `ws_message`
--

-- --------------------------------------------------------

--
-- 表的结构 `ws_news`
--

CREATE TABLE IF NOT EXISTS `ws_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `time` int(10) NOT NULL,
  `content` text NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `ws_news`
--
-- --------------------------------------------------------

--
-- 表的结构 `ws_plugin`
--

CREATE TABLE IF NOT EXISTS `ws_plugin` (
  `plugId` int(11) NOT NULL AUTO_INCREMENT,
  `plugName` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `plugPath` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `author` varchar(20) NOT NULL,
  `version` varchar(10) NOT NULL,
  PRIMARY KEY (`plugId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ws_plugin`
--

INSERT INTO `ws_plugin` (`plugId`, `plugName`, `status`, `plugPath`, `description`, `link`, `author`, `version`) VALUES
(1, 'friend', 1, 'friend_ws.php', 'test', 'http', 'iceweb', '1');

-- --------------------------------------------------------

--
-- 表的结构 `ws_pluginVar`
--

CREATE TABLE IF NOT EXISTS `ws_pluginVar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `varKey` varchar(20) NOT NULL,
  `varContent` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `ws_pluginVar`
--

INSERT INTO `ws_pluginVar` (`id`, `name`, `varKey`, `varContent`) VALUES
(1, 'friend', 'mytime', 'sfdsafasxxx');

-- --------------------------------------------------------

--
-- 表的结构 `ws_score`
--

CREATE TABLE IF NOT EXISTS `ws_score` (
  `scoreId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL,
  `scoreType` tinyint(1) NOT NULL,
  `num` int(10) NOT NULL,
  `memo` varchar(255) NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`scoreId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=312 ;

--
-- 转存表中的数据 `ws_score`
--
-- --------------------------------------------------------

--
-- 表的结构 `ws_site`
--

CREATE TABLE IF NOT EXISTS `ws_site` (
  `siteId` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `subTitle` varchar(20) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `noUser` text,
  `replaceWord` text,
  `copyright` text NOT NULL,
  `icp` varchar(20) DEFAULT NULL,
  `mailType` tinyint(1) DEFAULT NULL,
  `smtp` varchar(30) DEFAULT NULL,
  `smtpUser` varchar(20) DEFAULT NULL,
  `smtpPpwd` varchar(20) DEFAULT NULL,
  `receive` varchar(40) DEFAULT NULL,
  `mailText` text,
  `version` varchar(30) DEFAULT NULL,
  `home` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`siteId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ws_site`
--

INSERT INTO `ws_site` (`siteId`, `title`, `subTitle`, `description`, `keyword`, `noUser`, `replaceWord`, `copyright`, `icp`, `mailType`, `smtp`, `smtpUser`, `smtpPpwd`, `receive`, `mailText`, `version`, `home`) VALUES
(1, '大嶝开源微博V0.8-开源微博-微博开源-开源微博程序-微博--ThinkPHP--dadeng.org', '大嶝开源微博V0.8', '大嶝开源微博是基于开源框架Thinkphp开发的开源微博程序,！支持群组,话题,图片批量上传,MP3分享,V0.8版!支持文件上传,支持ucenter整合', '大嶝开源微博,大嶝网,开源微博,PHP开源,微博开源', 'admin&#124;大嶝&#124;iceweb&#124;vip&#124;管理员', '毛&#124;发票&#124;彩票&#124;色情&#124;法论功&#124;共产党&#124;奶子&#124;乳房&#124;国民党&#124;胡锦涛&#124;温家宝', '大嶝微博 版权所有 ©2010 <script src="http://s4.cnzz.com/stat.php?id=2145590&web_id=2145590" language="JavaScript"></script>', '闽ICP备10022095号', 1, 'smtp.163.com', 'webluoye', 'xxxxx', 'zweb@vip.qq.com', '您好：@userid@欢迎注册@site@，这是来自系统的激活邮件！\r\n点击下面的连接可以激活！', 'V0.8测试版', 'home');

-- --------------------------------------------------------

--
-- 表的结构 `ws_siteExt`
--

CREATE TABLE IF NOT EXISTS `ws_siteExt` (
  `siteExtId` tinyint(1) unsigned NOT NULL,
  `userCheck` tinyint(1) DEFAULT '1',
  `httpCheck` tinyint(1) DEFAULT '0',
  `mailCheck` tinyint(1) DEFAULT '0',
  `ipCheck` tinyint(1) DEFAULT '0',
  `sendCheck` tinyint(3) DEFAULT '0',
  `loginCheck` tinyint(3) DEFAULT '0',
  `scoreStart` tinyint(1) DEFAULT '1',
  `userScore` int(10) DEFAULT '10',
  `scoreLog` tinyint(1) DEFAULT '0',
  `loginScore` tinyint(2) DEFAULT '2',
  `createGet` tinyint(2) DEFAULT '2',
  `replayGet` tinyint(2) DEFAULT '1',
  `createDel` tinyint(2) DEFAULT '4',
  `replayDel` tinyint(2) DEFAULT '2',
  `hotScore` tinyint(2) DEFAULT '30',
  `inviteScore` tinyint(2) DEFAULT '20',
  `createGroup` tinyint(2) DEFAULT '10',
  `sendImg` tinyint(2) DEFAULT '4',
  `downloadScore` tinyint(2) DEFAULT '6',
  `uploadScore` tinyint(2) DEFAULT '4',
  `textLen` int(10) DEFAULT '140',
  `fileSize` int(10) DEFAULT '512000',
  `commentOpen` tinyint(1) DEFAULT '1',
  `unloginSend` tinyint(1) DEFAULT '0',
  `openReg` tinyint(1) DEFAULT '1',
  `inviteReg` tinyint(1) DEFAULT '0',
  `hotTime` tinyint(3) DEFAULT '48',
  `catchTime` tinyint(2) DEFAULT '20',
  `sendTime` tinyint(2) DEFAULT '5',
  `isClose` tinyint(1) NOT NULL DEFAULT '2',
  `closeInfo` varchar(200) NOT NULL,
  PRIMARY KEY (`siteExtId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ws_siteExt`
--

INSERT INTO `ws_siteExt` (`siteExtId`, `userCheck`, `httpCheck`, `mailCheck`, `ipCheck`, `sendCheck`, `loginCheck`, `scoreStart`, `userScore`, `scoreLog`, `loginScore`, `createGet`, `replayGet`, `createDel`, `replayDel`, `hotScore`, `inviteScore`, `createGroup`, `sendImg`, `downloadScore`, `uploadScore`, `textLen`, `fileSize`, `commentOpen`, `unloginSend`, `openReg`, `inviteReg`, `hotTime`, `catchTime`, `sendTime`, `isClose`, `closeInfo`) VALUES
(1, 0, 0, 0, 0, 0, 1, 1, 10, 2, 2, 2, 1, 4, 2, 30, 20, 10, 4, 6, 4, 160, 512000, 1, 0, 2, 2, 48, 20, 5, 2, '');

-- --------------------------------------------------------

--
-- 表的结构 `ws_tag`
--

CREATE TABLE IF NOT EXISTS `ws_tag` (
  `tagId` int(10) NOT NULL AUTO_INCREMENT,
  `topicId` text NOT NULL,
  `tagName` varchar(100) NOT NULL,
  `userId` int(10) NOT NULL,
  `time` int(10) NOT NULL,
  `home` varchar(30) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tagId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=97 ;

--
-- 转存表中的数据 `ws_tag`
--


-- --------------------------------------------------------

--
-- 表的结构 `ws_topic`
--

CREATE TABLE IF NOT EXISTS `ws_topic` (
  `topicId` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(160) NOT NULL,
  `userId` int(10) NOT NULL,
  `time` int(10) NOT NULL,
  `groupId` int(10) NOT NULL,
  `parentId` int(10) NOT NULL,
  `tagName` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `zhuan` int(10) NOT NULL DEFAULT '0',
  `share` varchar(20) NOT NULL DEFAULT '0',
  `client` varchar(20) NOT NULL DEFAULT '0',
  `home` varchar(30) NOT NULL DEFAULT '0',
  `address` varchar(20) NOT NULL DEFAULT '0',
  `lastTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ping` int(11) NOT NULL DEFAULT '0',
  `isShow` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`topicId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1670 ;

--
-- 转存表中的数据 `ws_topic`
--

-- --------------------------------------------------------

--
-- 表的结构 `ws_user`
--

CREATE TABLE IF NOT EXISTS `ws_user` (
  `userId` int(10) NOT NULL AUTO_INCREMENT,
  `userName` varchar(20) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `homePage` varchar(30) NOT NULL,
  `icon` varchar(17) DEFAULT NULL,
  `createTime` int(10) NOT NULL,
  `createIp` varchar(16) NOT NULL,
  `groupId` int(10) DEFAULT NULL,
  `roleId` int(10) NOT NULL,
  `score` int(10) NOT NULL,
  `nickName` varchar(10) NOT NULL,
  `memo` varchar(140) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `tags` varchar(200) NOT NULL,
  `province` varchar(10) DEFAULT NULL,
  `city` varchar(10) DEFAULT NULL,
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=591 ;

--
-- 转存表中的数据 `ws_user`
--

INSERT INTO `ws_user` (`userId`, `userName`, `mail`, `password`, `homePage`, `icon`, `createTime`, `createIp`, `groupId`, `roleId`, `score`, `nickName`, `memo`, `status`, `tags`, `province`, `city`, `sex`) VALUES
(39, 'rainer', '', 'ad9a797526e878d26f9b768a6bafa551', 'rainer', NULL, 1280126671, '59.44.110.2', 0, 0, 200, '', NULL, 1, '', NULL, NULL, 0);
-- --------------------------------------------------------

--
-- 表的结构 `ws_userExt`
--

CREATE TABLE IF NOT EXISTS `ws_userExt` (
  `userId` int(10) unsigned NOT NULL DEFAULT '0',
  `wbCount` int(10) unsigned NOT NULL DEFAULT '0',
  `gzCount` int(10) unsigned NOT NULL DEFAULT '0',
  `fsCount` int(10) unsigned NOT NULL DEFAULT '0',
  `loginTime` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `loginIp` varchar(15) NOT NULL DEFAULT '127.0.0.1',
  `sinaId` varchar(25) NOT NULL DEFAULT '0',
  `gmailId` varchar(35) NOT NULL DEFAULT '0',
  `oicqId` varchar(11) NOT NULL DEFAULT '0',
  `medal` varchar(200) NOT NULL,
  `theme` varchar(20) NOT NULL DEFAULT 'default',
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- 转存表中的数据 `ws_userExt`
--

INSERT INTO `ws_userExt` (`userId`, `wbCount`, `gzCount`, `fsCount`, `loginTime`, `loginIp`, `sinaId`, `gmailId`, `oicqId`, `medal`, `theme`) VALUES
(590, 0, 1, 0, '1000-01-01 00:00:00', '127.0.0.1', '0', '0', '0', '', 'default');
-- --------------------------------------------------------

--
-- 表的结构 `ws_usergroup`
--

CREATE TABLE IF NOT EXISTS `ws_userGroup` (
  `ugId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) NOT NULL,
  `groupId` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ugId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- 转存表中的数据 `ws_usergroup`
--

-- --------------------------------------------------------

--
-- 表的结构 `ws_visit`
--

CREATE TABLE IF NOT EXISTS `ws_visit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` int(10) unsigned NOT NULL,
  `ip` varchar(16) NOT NULL,
  `time` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `info` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4983 ;