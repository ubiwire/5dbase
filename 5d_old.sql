-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 02 月 08 日 02:16
-- 服务器版本: 5.5.16
-- PHP 版本: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `5d`
--

-- --------------------------------------------------------

--
-- 表的结构 `tbl_categories`
--

CREATE TABLE IF NOT EXISTS `tbl_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `org_id`, `name`, `user_id`, `create_at`, `update_at`) VALUES
(1, 3, '书籍', 7, '2012-12-12 14:56:22', '0000-00-00 00:00:00'),
(2, 2, '旅游', 1, '2012-12-12 16:02:24', '0000-00-00 00:00:00'),
(3, 3, '优惠券', 7, '2012-12-16 01:23:06', '0000-00-00 00:00:00'),
(4, 3, '书籍', 7, '2012-12-17 15:24:21', '0000-00-00 00:00:00'),
(5, 3, '书籍 1', 7, '2012-12-17 15:31:44', '0000-00-00 00:00:00'),
(6, 3, '狗屁分类', 7, '2012-12-18 15:12:42', '0000-00-00 00:00:00'),
(7, 3, '旅游', 7, '2012-12-18 15:14:49', '0000-00-00 00:00:00'),
(8, 3, '添加分类', 7, '2012-12-19 14:46:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(250) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_comments`
--

CREATE TABLE IF NOT EXISTS `tbl_comments` (
  `owner_name` varchar(50) NOT NULL,
  `owner_id` int(12) NOT NULL,
  `comment_id` int(12) NOT NULL AUTO_INCREMENT,
  `parent_comment_id` int(12) DEFAULT NULL,
  `creator_id` int(12) DEFAULT NULL,
  `user_name` varchar(128) DEFAULT NULL,
  `user_email` varchar(128) DEFAULT NULL,
  `comment_text` text,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`),
  KEY `owner_name` (`owner_name`,`owner_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `tbl_comments`
--

INSERT INTO `tbl_comments` (`owner_name`, `owner_id`, `comment_id`, `parent_comment_id`, `creator_id`, `user_name`, `user_email`, `comment_text`, `create_time`, `update_time`, `status`) VALUES
('Post', 2, 1, 0, 1, NULL, NULL, '122432423424', 1354888156, NULL, 0),
('Post', 2, 2, 1, 1, NULL, NULL, '3134534r34r', 1354888176, NULL, 0),
('Post', 2, 3, 0, 1, NULL, NULL, '1111111111111111', 1354888209, NULL, 0),
('Post', 2, 4, 0, 1, NULL, NULL, '13r34r34', 1354888215, NULL, 0),
('Post', 2, 5, 0, 1, NULL, NULL, '234t34f34r', 1354888222, NULL, 0),
('Post', 2, 6, 0, 7, NULL, NULL, '1324r32r', 1354888429, NULL, 0),
('Post', 2, 7, 5, 7, NULL, NULL, '32rrwerw', 1354888608, NULL, 0),
('Post', 2, 8, 0, 7, NULL, NULL, 'ewfr23r', 1354888832, NULL, 0),
('Post', 2, 9, 0, 7, NULL, NULL, 'sdf2rfwrf', 1355024289, NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_contacts`
--

CREATE TABLE IF NOT EXISTS `tbl_contacts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `carddata` longtext,
  `notes` longtext NOT NULL,
  `lastUpdated` varchar(30) DEFAULT NULL,
  `updatedBy` varchar(20) DEFAULT NULL,
  `priority` varchar(40) DEFAULT NULL,
  `leadSource` varchar(40) DEFAULT NULL,
  `leadDate` int(10) unsigned DEFAULT NULL,
  `rating` tinyint(4) DEFAULT NULL,
  `createDate` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_contacts_category`
--

CREATE TABLE IF NOT EXISTS `tbl_contacts_category` (
  `category_id` int(11) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_conversation`
--

CREATE TABLE IF NOT EXISTS `tbl_conversation` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'unique identifier',
  `uri` varchar(225) COLLATE utf8_bin DEFAULT NULL COMMENT 'URI of the conversation',
  `created` datetime NOT NULL COMMENT 'date this record was created',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'date this record was modified',
  PRIMARY KEY (`id`),
  UNIQUE KEY `conversation_uri_key` (`uri`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `tbl_conversation`
--

INSERT INTO `tbl_conversation` (`id`, `uri`, `created`, `modified`) VALUES
(1, '/5dbase/backend/wwwindex.php/conversation/1', '2013-01-21 16:00:02', '0000-00-00 00:00:00'),
(2, '/5dbase/backend/wwwindex.php/conversation/2', '2013-01-21 16:05:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `tbl_fave`
--

CREATE TABLE IF NOT EXISTS `tbl_fave` (
  `notice_id` int(11) NOT NULL COMMENT 'notice that is the favorite',
  `user_id` int(11) NOT NULL COMMENT 'user who likes this notice',
  `uri` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'universally unique identifier, usually a tag URI',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'date this record was modified',
  PRIMARY KEY (`notice_id`,`user_id`),
  UNIQUE KEY `fave_uri_key` (`uri`),
  KEY `fave_notice_id_idx` (`notice_id`),
  KEY `fave_user_id_idx` (`user_id`,`modified`),
  KEY `fave_modified_idx` (`modified`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_favorites`
--

CREATE TABLE IF NOT EXISTS `tbl_favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(1) NOT NULL DEFAULT '0',
  `post_id` int(1) NOT NULL DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_mentions`
--

CREATE TABLE IF NOT EXISTS `tbl_mentions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_messages`
--

CREATE TABLE IF NOT EXISTS `tbl_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(256) NOT NULL DEFAULT '',
  `body` text,
  `is_read` enum('0','1') NOT NULL DEFAULT '0',
  `deleted_by` enum('sender','receiver') DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sender` (`sender_id`),
  KEY `reciever` (`receiver_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `tbl_messages`
--

INSERT INTO `tbl_messages` (`id`, `sender_id`, `receiver_id`, `subject`, `body`, `is_read`, `deleted_by`, `created_at`) VALUES
(1, 1, 2, '第一封站内测试信', '第一封站内测试信\r\n内容。', '1', NULL, '2012-09-03 05:10:40'),
(2, 2, 1, 'Re: 第一封站内测试信', '来信已收到。', '0', 'receiver', '2012-09-03 05:21:09'),
(3, 2, 1, 'admin test ', 'test admin', '1', 'receiver', '2012-09-03 09:07:35');

-- --------------------------------------------------------

--
-- 表的结构 `tbl_news`
--

CREATE TABLE IF NOT EXISTS `tbl_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_type` int(11) NOT NULL DEFAULT '1',
  `title` varchar(128) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `org_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `tbl_news`
--

INSERT INTO `tbl_news` (`id`, `news_type`, `title`, `content`, `org_id`, `user_id`, `create_at`, `update_at`) VALUES
(1, 1, '团队工具', '团队工具团队工具', 3, 7, '2012-12-08 23:23:23', '2012-12-08 23:23:23'),
(2, 2, '名言', '名言名言名言名言名言', 3, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, '小游戏', '小游戏 小游戏 小游戏 小游戏 小游戏 小游戏 小游戏 小游戏 小游戏 小游戏 ', 3, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `tbl_notice`
--

CREATE TABLE IF NOT EXISTS `tbl_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'unique identifier',
  `user_id` int(11) NOT NULL COMMENT 'who made the update',
  `org_id` int(11) NOT NULL COMMENT 'belongs to org',
  `uri` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'universally unique identifier, usually a tag URI',
  `content` text CHARACTER SET utf8 COMMENT 'update content',
  `rendered` text COLLATE utf8_bin COMMENT 'HTML version of the content',
  `url` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'URL of any attachment (image, video, bookmark, whatever)',
  `created` datetime NOT NULL COMMENT 'date this record was created',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'date this record was modified',
  `reply_to` int(11) DEFAULT NULL COMMENT 'notice replied to (usually a guess)',
  `is_local` tinyint(4) DEFAULT '0' COMMENT 'notice was generated by a user',
  `source` varchar(32) COLLATE utf8_bin DEFAULT NULL COMMENT 'source of comment, like "web", "im", or "clientname"',
  `conversation` int(11) DEFAULT NULL COMMENT 'id of root notice in this conversation',
  `lat` decimal(10,7) DEFAULT NULL COMMENT 'latitude',
  `lon` decimal(10,7) DEFAULT NULL COMMENT 'longitude',
  `location_id` int(11) DEFAULT NULL COMMENT 'location id if possible',
  `location_ns` int(11) DEFAULT NULL COMMENT 'namespace for location',
  `repeat_of` int(11) DEFAULT NULL COMMENT 'notice this is a repeat of',
  `object_type` varchar(255) COLLATE utf8_bin DEFAULT 'http://activitystrea.ms/schema/1.0/note' COMMENT 'URI representing activity streams object type',
  `verb` varchar(255) COLLATE utf8_bin DEFAULT 'http://activitystrea.ms/schema/1.0/post' COMMENT 'URI representing activity streams verb',
  `scope` int(11) DEFAULT NULL COMMENT 'bit map for distribution scope; 0 = everywhere; 1 = this server only; 2 = addressees; 4 = followers; null = default',
  PRIMARY KEY (`id`),
  UNIQUE KEY `notice_uri_key` (`uri`),
  KEY `notice_created_id_is_local_idx` (`created`,`id`,`is_local`),
  KEY `notice_profile_id_idx` (`user_id`,`created`,`id`),
  KEY `notice_repeat_of_created_id_idx` (`repeat_of`,`created`,`id`),
  KEY `notice_conversation_created_id_idx` (`conversation`,`created`,`id`),
  KEY `notice_replyto_idx` (`reply_to`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `tbl_notice`
--

INSERT INTO `tbl_notice` (`id`, `user_id`, `org_id`, `uri`, `content`, `rendered`, `url`, `created`, `modified`, `reply_to`, `is_local`, `source`, `conversation`, `lat`, `lon`, `location_id`, `location_ns`, `repeat_of`, `object_type`, `verb`, `scope`) VALUES
(2, 7, 3, '/5dbase/backend/www/index.php/notice/2', 'ssssssfsfs', 0x73737373737366736673, NULL, '2013-01-21 16:00:02', '0000-00-00 00:00:00', NULL, 0, 'api', 1, 23.2342340, 23.2342340, NULL, NULL, NULL, 'http://activitystrea.ms/schema/1.0/note', 'http://activitystrea.ms/schema/1.0/post', 0),
(3, 7, 3, '/5dbase/backend/www/index.php/notice/3', 'last', 0x73737373737366736673, NULL, '2013-01-21 16:05:35', '2013-01-30 14:08:12', NULL, 0, 'api', 2, 23.2342340, 23.2342340, NULL, NULL, NULL, 'http://activitystrea.ms/schema/1.0/note', 'http://activitystrea.ms/schema/1.0/post', 0);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_orgs`
--

CREATE TABLE IF NOT EXISTS `tbl_orgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `photo_path` varchar(255) NOT NULL DEFAULT '',
  `company_name` varchar(255) NOT NULL DEFAULT '',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `creator_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `tbl_orgs`
--

INSERT INTO `tbl_orgs` (`id`, `name`, `slogan`, `photo_path`, `company_name`, `parent_id`, `create_at`, `update_at`, `creator_id`) VALUES
(1, '营销之道', NULL, '', '', 0, '2012-12-01 17:15:30', '0000-00-00 00:00:00', 0),
(2, '营销计划', NULL, '', '', 0, '2012-12-01 17:31:57', '0000-00-00 00:00:00', 0),
(3, '你我团队', '集结号就是口号', '1250130830.jpg', '知正12341', 0, '2012-12-01 17:35:53', '0000-00-00 00:00:00', 0),
(4, 'app协会', NULL, '', '', 0, '2013-01-05 13:25:14', '0000-00-00 00:00:00', 17);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_posts`
--

CREATE TABLE IF NOT EXISTS `tbl_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contents` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `comments_count` int(11) NOT NULL DEFAULT '0',
  `like_count` int(11) NOT NULL DEFAULT '0',
  `favorite_count` int(11) NOT NULL DEFAULT '0',
  `public` int(1) NOT NULL DEFAULT '0',
  `wb_type` int(1) NOT NULL DEFAULT '0',
  `refer_id` int(11) NOT NULL DEFAULT '0',
  `org_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `file_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `tbl_posts`
--

INSERT INTO `tbl_posts` (`id`, `contents`, `user_id`, `comments_count`, `like_count`, `favorite_count`, `public`, `wb_type`, `refer_id`, `org_id`, `create_at`, `update_at`, `file_path`) VALUES
(1, '大家好，，第一条微博。大家好，，第一条微博。大家好，，第一条微博。大家好，，第一条微博。大家好，，第一条微博。大家好，，第一条微博。', 7, 0, 0, 0, 0, 0, 0, 3, '2012-12-02 04:55:38', '0000-00-00 00:00:00', ''),
(2, '大家好，，第一条微博。大家好，，第一条微博。大家好，，第一条微博。大家好，，第一条微博。大家好，，第一条微博。大家好，，第一条微博。', 7, 1, 2, 3, 0, 0, 0, 3, '2012-12-02 04:55:46', '0000-00-00 00:00:00', ''),
(3, '第二条微博 第二条微博 第二条微博 第二条微博\r\n第二条微博、第二条微博第二条微博', 7, 0, 0, 0, 0, 0, 0, 3, '2012-12-19 16:00:00', '0000-00-00 00:00:00', NULL),
(4, 'asdffwefwef', 7, 0, 0, 0, 0, 0, 0, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(5, 'sfadw3efsdfsadf', 7, 0, 0, 0, 0, 0, 0, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(6, '首页 微博首页 微博首页 微博首页 微博首页 微博首页 微首页 微博首页 微博博', 7, 0, 0, 0, 0, 0, 0, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(7, '首页 微博首页 微博首页 微博首页 微博首页 微博首页 微博', 7, 0, 0, 0, 0, 0, 0, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1356018593751.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `tbl_productions`
--

CREATE TABLE IF NOT EXISTS `tbl_productions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `descriptor` text,
  `original_pic_path` varchar(255) NOT NULL DEFAULT '',
  `process_picture_path` varchar(255) NOT NULL DEFAULT '',
  `org_id` int(11) NOT NULL DEFAULT '0',
  `inventory` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `tbl_productions`
--

INSERT INTO `tbl_productions` (`id`, `name`, `price`, `descriptor`, `original_pic_path`, `process_picture_path`, `org_id`, `inventory`, `category_id`, `status`, `create_at`, `update_at`) VALUES
(1, '钢铁是怎样炼成的', 10, '钢铁是怎样炼成的 钢铁是怎样炼成的 钢铁是怎样炼成的', '', '', 3, 100, 1, 1, '2012-12-13 06:31:44', '0000-00-00 00:00:00'),
(2, '钢铁是怎样炼成的22', 10, '钢铁是怎样炼成的钢铁是怎样炼成的钢铁是怎样炼成的钢铁是怎样炼成的', '', '', 0, 100, 1, 1, '2012-12-13 06:34:29', '0000-00-00 00:00:00'),
(3, 'ruby 元编程', 20, 'ruby 元编程\r\nruby 元编程\r\nruby 元编程\r\n', '', '', 3, 10, 1, 1, '2012-12-13 06:39:38', '0000-00-00 00:00:00'),
(4, '接口', 10, '接口', '1355489836919.jpg', '', 3, 1002, 1, 0, '2012-12-14 04:57:16', '0000-00-00 00:00:00'),
(5, '素描', 13, '素描 素描 素描 素描 素描素描 素描素描', '1355579054462.jpg', '', 3, 11, 1, 0, '2012-12-15 05:44:14', '0000-00-00 00:00:00'),
(6, '美女', 12, '美女 美女美女 美女美女 美女美女 美女美女 美女', '1355580544756.jpg', '', 3, 12, 1, 0, '2012-12-15 06:09:04', '0000-00-00 00:00:00'),
(7, '风景', 10, '我希望将一个字符串限长显示,如果该字符串超过一定长数,就截取前n个字符,后加省略号... php字符串截取问题发布:dxy 字体:[增加 减小] 类型:转载 我希望将一个', '1355583562612.jpg', '', 3, 12, 1, 0, '2012-12-15 06:59:22', '0000-00-00 00:00:00'),
(8, '创意', 10, '创意 创意创意创意 创意 创意 创意创意创意 创意创意 创意创意创意 创意创意 创意创意创意 创意创意 创意创意创意 创意创意 创意创意创意 创意创意 创意创意创意 创意创意 创意创意创意 创意创意 创意创意创意 创意创意 创意创意创意 创意创意 创意创意创意 创意创意 创意创意创意 创意创意 创意创意创意 创意', '1357649959321.jpg', '', 3, 210, 1, 0, '2012-12-15 07:15:03', '0000-00-00 00:00:00'),
(9, '千位刷', 1, '优惠券 优惠券 优惠券 优惠券 优惠券 优惠券 优惠券 优惠券 优惠券 优惠券 优惠券 优惠券 优惠券 优惠券 优惠券 优惠券\r\n优惠券 优惠券 优惠券 优惠券 优惠券 优惠券 优惠券 优惠券\r\n优惠券 优惠券 优惠券 优惠券 优惠券 优惠券 优惠券 优惠券\r\n优惠券 优惠券 优惠券 优惠券 优惠券 优惠券 优惠券 优惠券', '1355621097864.jpg', '', 3, 12, 3, 0, '2012-12-15 17:24:57', '0000-00-00 00:00:00'),
(10, '绝味鸭脖', 10, '绝味鸭脖 绝味鸭脖\r\n绝味鸭脖\r\n绝味鸭脖\r\n绝味鸭脖', '1355842000152.jpg', '', 3, 110, 3, 0, '2012-12-18 06:46:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `tbl_profiles`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `reward_point` int(10) NOT NULL DEFAULT '0',
  `surplus_total` int(10) NOT NULL DEFAULT '0',
  `usage` int(10) NOT NULL DEFAULT '0',
  `photo_path` varchar(100) NOT NULL DEFAULT '',
  `nickname` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `tbl_profiles`
--

INSERT INTO `tbl_profiles` (`user_id`, `lastname`, `firstname`, `birthday`, `reward_point`, `surplus_total`, `usage`, `photo_path`, `nickname`) VALUES
(1, 'Admin', 'Administrator', '1979-10-27', 0, 0, 0, '', ''),
(2, 'Demo', 'Demorr', '0000-00-00', 0, 0, 0, '', ''),
(3, 'wang', 'john', '2012-09-19', 0, 0, 0, '', ''),
(4, 'fang', 'martin', '1988-06-06', 0, 0, 0, '', ''),
(7, 'fang', 'martin', '1989-07-13', 0, 0, 0, '1357652133636.jpg', ''),
(8, '', '', '0000-00-00', 0, 0, 0, '', ''),
(14, '', '', '0000-00-00', 0, 0, 0, '', ''),
(15, '', '', '0000-00-00', 0, 0, 0, '', ''),
(16, '', '', '0000-00-00', 0, 0, 0, '', ''),
(17, 'yan', 'june', '0000-00-00', 0, 0, 0, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `tbl_profiles_fields`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `tbl_profiles_fields`
--

INSERT INTO `tbl_profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'lastname', 'Last Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 1, 3),
(2, 'firstname', 'First Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 0, 3),
(3, 'birthday', '生日', 'DATE', '0', '0', 0, '', '', '生日格式不正确', '', '0000-00-00', 'UWjuidate', '{"ui-theme":"base","language":"en"}', 0, 3),
(4, 'reward_point', '积分总数', 'INTEGER', '10', '0', 0, '', '', '', '', '0', '', '', 0, 1),
(5, 'surplus_total', '剩余总额', 'INTEGER', '10', '0', 0, '', '', '', '', '0', '', '', 0, 2),
(6, 'usage', '消费总额', 'INTEGER', '10', '0', 0, '', '', '', '', '0', '', '', 0, 2),
(7, 'photo_path', '照片', 'VARCHAR', '100', '0', 2, '', '', '文件格式不正确', '{"file":{"allowEmpty":"true","types":"jpg, gif, png"}}', '', 'UWfile', '{"path":"E:/fsn_workspace/xampp/htdocs/5dbase/backend/www/assets/uploads/profiles"}', 0, 3),
(8, 'nickname', '昵称', 'VARCHAR', '25', '0', 0, '', '', '', '', '', '', '', 0, 3);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_reply`
--

CREATE TABLE IF NOT EXISTS `tbl_reply` (
  `notice_id` int(11) NOT NULL COMMENT 'notice that is the reply',
  `profile_id` int(11) NOT NULL COMMENT 'profile replied to',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'date this record was modified',
  `replied_id` int(11) DEFAULT NULL COMMENT 'notice replied to (not used, see notice.reply_to)',
  PRIMARY KEY (`notice_id`,`profile_id`),
  KEY `reply_notice_id_idx` (`notice_id`),
  KEY `reply_profile_id_idx` (`profile_id`),
  KEY `reply_replied_id_idx` (`replied_id`),
  KEY `reply_profile_id_modified_notice_id_idx` (`profile_id`,`modified`,`notice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_reward_points`
--

CREATE TABLE IF NOT EXISTS `tbl_reward_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `total` int(11) NOT NULL DEFAULT '0',
  `usage` int(11) NOT NULL DEFAULT '0',
  `org_id` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `tbl_reward_points`
--

INSERT INTO `tbl_reward_points` (`id`, `date`, `total`, `usage`, `org_id`, `status`, `create_at`, `update_at`) VALUES
(17, 1354579200, 2, 0, 3, 0, '2012-12-16 14:42:52', '0000-00-00 00:00:00'),
(18, 1357603200, 110, 0, 4, 0, '2013-01-05 13:27:58', '0000-00-00 00:00:00'),
(19, 1360108800, 110, 0, 4, 0, '2013-01-05 14:28:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `tbl_reward_point_grant`
--

CREATE TABLE IF NOT EXISTS `tbl_reward_point_grant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '0',
  `granter_id` int(11) NOT NULL DEFAULT '0' COMMENT '积分发放者id ，兑换时则为0 ',
  `recipient_id` int(11) NOT NULL DEFAULT '0' COMMENT '积分操作对象，一般为队员id',
  `reward_val` int(11) NOT NULL DEFAULT '0' COMMENT '所需积分值',
  `granter_type` int(1) NOT NULL DEFAULT '0' COMMENT '定义是积分发放或积分兑换',
  `usage` int(11) NOT NULL DEFAULT '0' COMMENT '积分用途，兑换的时候，一般为礼品id',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reason` varchar(255) NOT NULL COMMENT '积分发放的理由，兑换则为空',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_sms`
--

CREATE TABLE IF NOT EXISTS `tbl_sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_uid` int(11) DEFAULT '0',
  `to_uid` int(11) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `content` text,
  `sendtime` datetime DEFAULT NULL,
  `status` text,
  `remark` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_sms_setup`
--

CREATE TABLE IF NOT EXISTS `tbl_sms_setup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `providertype` varchar(32) DEFAULT NULL,
  `parameters` text,
  `isactive` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sms_setup_schools_fk_1` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tbl_sms_setup`
--

INSERT INTO `tbl_sms_setup` (`id`, `user_id`, `username`, `password`, `providertype`, `parameters`, `isactive`) VALUES
(1, 7, 'snfang', 'admin', 'ShangTong', NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `tel` varchar(15) NOT NULL COMMENT '手机号',
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `roles` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'manager',
  `org_id` int(11) NOT NULL COMMENT '外键',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`),
  KEY `org_id` (`org_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `email`, `tel`, `activkey`, `create_at`, `lastvisit_at`, `superuser`, `status`, `roles`, `org_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'webmaster@example.com', '', '9a24eff8c15a6a141ece27eb6947da0f', '2012-09-02 18:28:30', '2012-11-29 22:24:28', 1, 1, 'admin', 0),
(2, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@example.com', '', '87ebc08a142bf24616e439c950d457f8', '2012-09-02 18:28:30', '2012-11-06 16:25:26', 0, 1, '0', 0),
(3, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@gg.com', '', '5f9430e37c215dcb8b49cfc6654bd1d1', '2012-09-02 19:35:06', '0000-00-00 00:00:00', 0, 1, '0', 0),
(4, 'jing', 'aa3f6926fe23b4cd15480ec872616581', 'jk_info@126.com', '', '26bc800dd291790b4eb5eeb91d73a86b', '2012-11-29 04:57:08', '2012-11-28 21:04:41', 0, 1, '0', 0),
(7, 'snfang', '21232f297a57a5a743894a0e4a801fc3', 'sn_funnily@gmail.com', '13662272337', '1ad09be7e1e827a8970bb650cfde9672', '2012-12-01 17:35:53', '2013-02-06 23:07:28', 0, 1, 'manager', 3),
(8, 'snfang001', 'e10adc3949ba59abbe56e057f20f883e', '', '13665567887', '2549b8b41a2b823d09812e7d31a813d4', '2013-01-04 14:42:12', '0000-00-00 00:00:00', 0, 1, 'manager', 0),
(13, 'snfang002', 'e10adc3949ba59abbe56e057f20f883e', 'asdfs@asdf.com', '13454345454', '61aa7d82fa071a1f672b70e7bc63db77', '2013-01-04 15:11:32', '0000-00-00 00:00:00', 0, 1, 'manager', 0),
(14, 'snfang003', 'e10adc3949ba59abbe56e057f20f883e', NULL, '13567345654', '133c53fadc3cff4b1bad2d99a7a58aff', '2013-01-04 15:13:09', '0000-00-00 00:00:00', 0, 1, 'manager', 0),
(15, 'snfang004', 'e10adc3949ba59abbe56e057f20f883e', NULL, '13478457845', '15c95c20a639ca13418ae10cb4cb0138', '2013-01-04 15:17:37', '0000-00-00 00:00:00', 0, 1, 'member', 3),
(16, 'snfang007', 'e10adc3949ba59abbe56e057f20f883e', NULL, '13548754561', 'c02d581473ddd84e3d689facd96a5245', '2013-01-04 15:29:02', '0000-00-00 00:00:00', 0, 1, 'member', 0),
(17, 'jing008', '21232f297a57a5a743894a0e4a801fc3', 'asd@a.com', '13547854785', '6c9167c90cadc75c88f26d293aeaa68a', '2013-01-05 13:25:15', '2013-01-05 05:25:29', 0, 1, 'manager', 4);

--
-- 限制导出的表
--

--
-- 限制表 `tbl_profiles`
--
ALTER TABLE `tbl_profiles`
  ADD CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;