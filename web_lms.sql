-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2016 at 04:11 PM
-- Server version: 5.5.46
-- PHP Version: 5.6.17-1+deb.sury.org~precise+2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `web_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_ask_trainer`
--

CREATE TABLE IF NOT EXISTS `tb_lms_ask_trainer` (
  `qn_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_crs_id` int(11) NOT NULL,
  `qstn_detail` text CHARACTER SET utf8 NOT NULL,
  `qstn_file` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `status` enum('a','i') COLLATE utf8_bin NOT NULL DEFAULT 'a',
  `posted_by` int(11) NOT NULL,
  `posted_on` date NOT NULL,
  PRIMARY KEY (`qn_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='handle user questions that are asked to Trainer' AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_ask_trainer_ans`
--

CREATE TABLE IF NOT EXISTS `tb_lms_ask_trainer_ans` (
  `qans_id` int(11) NOT NULL AUTO_INCREMENT,
  `qn_id` int(11) NOT NULL,
  `ans_details` text NOT NULL,
  `ans_file` varchar(200) DEFAULT NULL,
  `answer_by` int(11) NOT NULL,
  `answer_on` date NOT NULL,
  PRIMARY KEY (`qans_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='trainer questions answer data table' AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_client`
--

CREATE TABLE IF NOT EXISTS `tb_lms_client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `client_email` varchar(200) CHARACTER SET utf8 NOT NULL,
  `client_descr` text CHARACTER SET utf8 NOT NULL,
  `client_image` varchar(200) CHARACTER SET utf8 NOT NULL,
  `client_url` varchar(200) CHARACTER SET utf8 NOT NULL,
  `client_address` text CHARACTER SET utf8 NOT NULL,
  `creation_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `client_dir` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'client repository for saving the files',
  `status` enum('a','i') CHARACTER SET utf8 NOT NULL DEFAULT 'a',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_contactus`
--

CREATE TABLE IF NOT EXISTS `tb_lms_contactus` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_email` varchar(120) CHARACTER SET utf8 NOT NULL,
  `user_details` text CHARACTER SET utf8 NOT NULL,
  `user_contact` varchar(100) CHARACTER SET utf8 NOT NULL,
  `posting_date` date NOT NULL,
  `user_ip` varchar(20) CHARACTER SET utf8 NOT NULL,
  `user_interest` varchar(220) CHARACTER SET utf8 NOT NULL,
  `company_url` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_know` text CHARACTER SET utf8 NOT NULL COMMENT 'where you got to know about me',
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_course`
--

CREATE TABLE IF NOT EXISTS `tb_lms_course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(200) COLLATE utf8_bin NOT NULL,
  `course_image` varchar(200) COLLATE utf8_bin NOT NULL,
  `course_descr` text CHARACTER SET utf8 NOT NULL,
  `course_url` varchar(200) CHARACTER SET utf8 NOT NULL,
  `course_price` varchar(10) COLLATE utf8_bin NOT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `course_rating` int(11) NOT NULL,
  `course_dir` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'course content directory for placing of course files',
  `status` enum('a','i') COLLATE utf8_bin NOT NULL DEFAULT 'a',
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_course_asg`
--

CREATE TABLE IF NOT EXISTS `tb_lms_course_asg` (
  `asg_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `asg_title` varchar(200) COLLATE utf8_bin NOT NULL,
  `asg_details` text CHARACTER SET utf8 NOT NULL,
  `asg_file` varchar(120) COLLATE utf8_bin DEFAULT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` enum('a','i') COLLATE utf8_bin NOT NULL DEFAULT 'a',
  PRIMARY KEY (`asg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_course_ass`
--

CREATE TABLE IF NOT EXISTS `tb_lms_course_ass` (
  `ass_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `ass_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `ass_details` text CHARACTER SET utf8 NOT NULL,
  `ass_instruct` text CHARACTER SET utf8 NOT NULL,
  `ass_time` int(11) DEFAULT NULL COMMENT 'total time in minutes only',
  `ass_attempt` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_publish` enum('y','n') COLLATE utf8_bin NOT NULL DEFAULT 'n',
  `published_on` datetime DEFAULT NULL,
  `publish_by` int(11) DEFAULT NULL,
  `status` enum('a','i') CHARACTER SET utf8 NOT NULL DEFAULT 'a',
  PRIMARY KEY (`ass_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_course_ass_qstn`
--

CREATE TABLE IF NOT EXISTS `tb_lms_course_ass_qstn` (
  `ass_q_id` int(11) NOT NULL AUTO_INCREMENT,
  `ass_id` int(11) NOT NULL,
  `qstn_id` int(11) NOT NULL,
  `qstn_time` int(11) DEFAULT NULL COMMENT 'time in minute',
  `qstn_marks` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`ass_q_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=73 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_course_classess`
--

CREATE TABLE IF NOT EXISTS `tb_lms_course_classess` (
  `crs_on_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `training_title` varchar(250) CHARACTER SET utf8 NOT NULL,
  `training_url` varchar(250) COLLATE utf8_bin NOT NULL,
  `training_details` text CHARACTER SET utf8,
  `training_agenda` text CHARACTER SET utf8,
  `training_date` date NOT NULL,
  `training_time` varchar(100) CHARACTER SET utf8 NOT NULL,
  `training_duration` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `status` enum('a','i') COLLATE utf8_bin NOT NULL DEFAULT 'a',
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`crs_on_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_course_group`
--

CREATE TABLE IF NOT EXISTS `tb_lms_course_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `group_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `group_detail` text CHARACTER SET utf8,
  `status` enum('a','i') CHARACTER SET utf8 NOT NULL DEFAULT 'a',
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_course_lib`
--

CREATE TABLE IF NOT EXISTS `tb_lms_course_lib` (
  `clib_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `lib_details` text NOT NULL,
  `lib_file` varchar(200) DEFAULT NULL,
  `status` enum('PVT','PUB') NOT NULL DEFAULT 'PVT',
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY (`clib_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='trainer course library' AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_course_qstn`
--

CREATE TABLE IF NOT EXISTS `tb_lms_course_qstn` (
  `qstn_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `qstn_type` enum('TF','MCMA','MCSA') CHARACTER SET utf8 NOT NULL DEFAULT 'MCSA',
  `qstn_detail` text CHARACTER SET utf8 NOT NULL,
  `qstn_hint` text CHARACTER SET utf8 NOT NULL,
  `diff_level` enum('E','M','H') CHARACTER SET utf8 NOT NULL DEFAULT 'E',
  `qstn_time` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` enum('a','i') COLLATE utf8_bin NOT NULL DEFAULT 'a',
  PRIMARY KEY (`qstn_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_course_qstn_optn`
--

CREATE TABLE IF NOT EXISTS `tb_lms_course_qstn_optn` (
  `qst_opt_id` int(11) NOT NULL AUTO_INCREMENT,
  `qstn_id` int(11) NOT NULL,
  `qst_opt_val` text CHARACTER SET utf8 NOT NULL,
  `right_flag` enum('T','F') CHARACTER SET utf8 NOT NULL DEFAULT 'F',
  PRIMARY KEY (`qst_opt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=126 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_crsgrp_user`
--

CREATE TABLE IF NOT EXISTS `tb_lms_crsgrp_user` (
  `crs_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `usr_crs_id` int(11) NOT NULL,
  PRIMARY KEY (`crs_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='student group users' AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_crs_module`
--

CREATE TABLE IF NOT EXISTS `tb_lms_crs_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `module_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `module_descr` text CHARACTER SET utf8 NOT NULL,
  `module_image` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `module_time` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` enum('a','i') CHARACTER SET utf8 NOT NULL DEFAULT 'a',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=129 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_demo`
--

CREATE TABLE IF NOT EXISTS `tb_lms_demo` (
  `demo_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_details` text COLLATE utf8_bin NOT NULL,
  `user_company` varchar(200) CHARACTER SET utf8 NOT NULL,
  `user_emp_range` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_mobile` varchar(20) CHARACTER SET utf8 NOT NULL,
  `user_ip` varchar(20) CHARACTER SET utf8 NOT NULL,
  `company_url` varchar(100) CHARACTER SET utf8 NOT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY (`demo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_mod_content`
--

CREATE TABLE IF NOT EXISTS `tb_lms_mod_content` (
  `cont_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `cont_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `cont_descr` text CHARACTER SET utf8,
  `cont_type` enum('SWF','VID','FILE','FAQ','TXT','ASG','PAQ') CHARACTER SET utf8 NOT NULL DEFAULT 'TXT',
  `file_path` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `file_uid` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `cont_text` text CHARACTER SET utf8,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `status` enum('a','i') CHARACTER SET utf8 NOT NULL DEFAULT 'a',
  PRIMARY KEY (`cont_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=272 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_my_libs`
--

CREATE TABLE IF NOT EXISTS `tb_lms_my_libs` (
  `lib_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_crs_id` int(11) NOT NULL,
  `lib_details` text CHARACTER SET utf8 NOT NULL,
  `lib_file` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `status` enum('PVT','PUB') CHARACTER SET utf8 NOT NULL DEFAULT 'PVT',
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY (`lib_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ucs2 COMMENT='user library files table, to store user files' AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_newssubscr`
--

CREATE TABLE IF NOT EXISTS `tb_lms_newssubscr` (
  `subscr_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_address` varchar(100) NOT NULL,
  `subscr_date` datetime NOT NULL,
  `subscr_ip` varchar(20) NOT NULL,
  `subscr_status` enum('a','i') NOT NULL DEFAULT 'a',
  PRIMARY KEY (`subscr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='newsletter subscription user list' AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_user`
--

CREATE TABLE IF NOT EXISTS `tb_lms_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `login_id` varchar(200) CHARACTER SET utf8 NOT NULL,
  `login_pass` varchar(200) COLLATE utf8_bin NOT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `user_type` enum('ADM','ACC','FAC','STD','SA','CA','IA') CHARACTER SET utf8 NOT NULL DEFAULT 'STD',
  `user_dir` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `user_ip` varchar(20) CHARACTER SET utf8 NOT NULL,
  `user_mobile` varchar(20) CHARACTER SET utf8 NOT NULL,
  `user_address` text CHARACTER SET utf8,
  `user_qualif` varchar(220) CHARACTER SET utf8 DEFAULT NULL,
  `user_univ` varchar(220) CHARACTER SET utf8 DEFAULT NULL,
  `user_college` varchar(220) CHARACTER SET utf8 DEFAULT NULL,
  `user_cv` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `user_interest` text CHARACTER SET utf8,
  `other_email` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `user_skype` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `user_fburl` varchar(220) COLLATE utf8_bin DEFAULT NULL,
  `user_gplusurl` varchar(220) COLLATE utf8_bin DEFAULT NULL,
  `user_lnurl` varchar(220) COLLATE utf8_bin DEFAULT NULL,
  `user_summary` text CHARACTER SET utf8,
  `user_photo` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `status` enum('a','i') CHARACTER SET utf8 NOT NULL DEFAULT 'a',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_user_crs`
--

CREATE TABLE IF NOT EXISTS `tb_lms_user_crs` (
  `usr_crs_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `reg_no` int(11) DEFAULT NULL,
  `access_days` int(11) DEFAULT NULL,
  `is_online` enum('y','n') COLLATE utf8_bin NOT NULL DEFAULT 'n' COMMENT 'for online user - online class',
  `user_comment` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` enum('a','i') COLLATE utf8_bin NOT NULL DEFAULT 'a',
  PRIMARY KEY (`usr_crs_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_user_crs_asg`
--

CREATE TABLE IF NOT EXISTS `tb_lms_user_crs_asg` (
  `crs_asg_id` int(11) NOT NULL AUTO_INCREMENT,
  `asg_id` int(11) NOT NULL,
  `usr_crs_id` int(11) NOT NULL,
  `asg_comment` text CHARACTER SET utf8,
  `assign_date` date NOT NULL,
  `submit_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`crs_asg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_user_crs_asg_sub`
--

CREATE TABLE IF NOT EXISTS `tb_lms_user_crs_asg_sub` (
  `asg_sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `crs_asg_id` int(11) NOT NULL,
  `submit_date` date NOT NULL,
  `file_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `sub_asg_details` text CHARACTER SET utf8 NOT NULL,
  `submit_by` int(11) NOT NULL COMMENT 'logged in user id',
  `asg_rate` int(11) DEFAULT NULL,
  `asg_comment` text CHARACTER SET utf8,
  `asg_eval_date` date DEFAULT NULL,
  PRIMARY KEY (`asg_sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_user_crs_ass`
--

CREATE TABLE IF NOT EXISTS `tb_lms_user_crs_ass` (
  `crs_ass_id` int(11) NOT NULL AUTO_INCREMENT,
  `ass_id` int(11) NOT NULL,
  `usr_crs_id` int(11) NOT NULL,
  `assigned_on` datetime NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `status` enum('a','i') NOT NULL DEFAULT 'a',
  PRIMARY KEY (`crs_ass_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_user_crs_ass_atmt`
--

CREATE TABLE IF NOT EXISTS `tb_lms_user_crs_ass_atmt` (
  `ass_atmt_id` int(11) NOT NULL AUTO_INCREMENT,
  `crs_ass_id` int(11) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `attempt_on` datetime NOT NULL,
  `attempt_count` int(11) NOT NULL,
  `browser_name` varchar(200) NOT NULL,
  `exit_mode` enum('ui','sq','te') NOT NULL DEFAULT 'ui' COMMENT 'ui-user interuption, sq-selft quit, te- time ends',
  PRIMARY KEY (`ass_atmt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='User Assessment Attempt ' AUTO_INCREMENT=90 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_user_crs_ass_atmt_mgr`
--

CREATE TABLE IF NOT EXISTS `tb_lms_user_crs_ass_atmt_mgr` (
  `atmt_mgr_id` int(11) NOT NULL AUTO_INCREMENT,
  `ass_atmt_id` int(11) NOT NULL,
  `qstn_id` int(11) NOT NULL,
  `qst_opt_id` int(11) DEFAULT NULL,
  `is_review` enum('y','n') NOT NULL DEFAULT 'n',
  `opt_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`atmt_mgr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='User Assessment Attempt Attempt Handler' AUTO_INCREMENT=298 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_user_crs_feedback`
--

CREATE TABLE IF NOT EXISTS `tb_lms_user_crs_feedback` (
  `crs_fbd_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_crs_id` int(11) NOT NULL,
  `fbt_title` varchar(250) CHARACTER SET utf8 NOT NULL,
  `fbd_descr` text CHARACTER SET utf8 NOT NULL,
  `fbd_rating` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `posted_on` date NOT NULL,
  PRIMARY KEY (`crs_fbd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_user_crs_notes`
--

CREATE TABLE IF NOT EXISTS `tb_lms_user_crs_notes` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_crs_id` int(11) NOT NULL,
  `note_details` text CHARACTER SET utf8 NOT NULL,
  `note_rate` int(11) DEFAULT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_user_crs_payment`
--

CREATE TABLE IF NOT EXISTS `tb_lms_user_crs_payment` (
  `crs_pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_crs_id` int(11) NOT NULL,
  `pay_amount` int(11) NOT NULL,
  `pay_type` enum('PART','FULL') CHARACTER SET utf8 NOT NULL,
  `pay_date` date NOT NULL,
  `updated_by` int(11) NOT NULL,
  `comment` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`crs_pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_usr_crs_qstn`
--

CREATE TABLE IF NOT EXISTS `tb_lms_usr_crs_qstn` (
  `crs_qid` int(11) NOT NULL AUTO_INCREMENT,
  `usr_crs_id` int(11) NOT NULL,
  `crs_q_dtl` text CHARACTER SET utf8 NOT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` enum('O','C') CHARACTER SET utf8 NOT NULL DEFAULT 'O',
  PRIMARY KEY (`crs_qid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_usr_crs_qstn_ans`
--

CREATE TABLE IF NOT EXISTS `tb_lms_usr_crs_qstn_ans` (
  `q_ans_id` int(11) NOT NULL AUTO_INCREMENT,
  `crs_qid` int(11) NOT NULL,
  `q_ans_detail` text CHARACTER SET utf8 NOT NULL,
  `posted_by` int(11) NOT NULL,
  `posted_on` date NOT NULL,
  PRIMARY KEY (`q_ans_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pb_lms_ass_atmt_cat`
--

CREATE TABLE IF NOT EXISTS `tb_pb_lms_ass_atmt_cat` (
  `ass_atmt_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `pb_as_atmid` int(11) NOT NULL,
  `qst_cat_id` int(11) NOT NULL,
  `is_attempted` enum('y','n') NOT NULL DEFAULT 'n',
  PRIMARY KEY (`ass_atmt_cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pb_lms_ass_stream`
--

CREATE TABLE IF NOT EXISTS `tb_pb_lms_ass_stream` (
  `stream_id` int(11) NOT NULL AUTO_INCREMENT,
  `stream_name` varchar(250) NOT NULL,
  `status` enum('a','i') NOT NULL DEFAULT 'a',
  PRIMARY KEY (`stream_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pb_lms_public_ass`
--

CREATE TABLE IF NOT EXISTS `tb_pb_lms_public_ass` (
  `ass_id` int(11) NOT NULL AUTO_INCREMENT,
  `stream_id` int(11) NOT NULL,
  `ass_title` varchar(200) NOT NULL,
  `ass_details` text NOT NULL,
  `ass_instruct` text NOT NULL,
  `ass_time` int(11) DEFAULT NULL COMMENT 'total time in minutes only',
  `ass_attempt` int(11) NOT NULL,
  `qstn_count` int(11) DEFAULT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_publish` enum('y','n') NOT NULL DEFAULT 'n',
  `is_categorized` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_scholarship` enum('1','2') NOT NULL DEFAULT '2',
  `published_on` datetime DEFAULT NULL,
  `publish_by` int(11) DEFAULT NULL,
  `status` enum('a','i') NOT NULL DEFAULT 'a',
  PRIMARY KEY (`ass_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pb_lms_public_ass_qstn`
--

CREATE TABLE IF NOT EXISTS `tb_pb_lms_public_ass_qstn` (
  `ass_q_id` int(11) NOT NULL AUTO_INCREMENT,
  `ass_id` int(11) NOT NULL,
  `qst_cat_id` int(11) NOT NULL,
  `qstn_id` int(11) NOT NULL,
  `qstn_time` int(11) DEFAULT NULL COMMENT 'time in minute',
  `qstn_marks` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`ass_q_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=82 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pb_lms_public_qstn`
--

CREATE TABLE IF NOT EXISTS `tb_pb_lms_public_qstn` (
  `qstn_id` int(11) NOT NULL AUTO_INCREMENT,
  `qst_cat_id` int(11) NOT NULL,
  `qstn_type` enum('TF','MCMA','MCSA') CHARACTER SET utf8 NOT NULL DEFAULT 'MCSA',
  `qstn_detail` text CHARACTER SET utf8 NOT NULL,
  `qstn_hint` text CHARACTER SET utf8 NOT NULL,
  `diff_level` enum('E','M','H') CHARACTER SET utf8 NOT NULL DEFAULT 'E',
  `qstn_time` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` enum('a','i') COLLATE utf8_bin NOT NULL DEFAULT 'a',
  PRIMARY KEY (`qstn_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=51 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pb_lms_public_qstn_optn`
--

CREATE TABLE IF NOT EXISTS `tb_pb_lms_public_qstn_optn` (
  `qst_opt_id` int(11) NOT NULL AUTO_INCREMENT,
  `qstn_id` int(11) NOT NULL,
  `qst_opt_val` text CHARACTER SET utf8 NOT NULL,
  `right_flag` enum('T','F') CHARACTER SET utf8 NOT NULL DEFAULT 'F',
  PRIMARY KEY (`qst_opt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=251 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pb_lms_qstn_category`
--

CREATE TABLE IF NOT EXISTS `tb_pb_lms_qstn_category` (
  `qst_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `qst_cat_name` varchar(250) NOT NULL,
  `status` enum('a','i') NOT NULL DEFAULT 'a',
  PRIMARY KEY (`qst_cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pb_lms_register`
--

CREATE TABLE IF NOT EXISTS `tb_pb_lms_register` (
  `pb_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `pb_user_type` enum('STD','ADM') NOT NULL DEFAULT 'STD',
  `pb_first_name` varchar(200) NOT NULL,
  `pb_last_name` varchar(50) NOT NULL,
  `pb_user_email` varchar(100) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `pb_user_contact` varchar(20) NOT NULL,
  `pb_crt_on` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `status` enum('a','i') NOT NULL DEFAULT 'a',
  `pub_user_qualif` varchar(200) DEFAULT NULL,
  `pub_user_college` varchar(200) DEFAULT NULL,
  `pub_user_stream` varchar(200) DEFAULT NULL,
  `pub_user_experience` int(11) DEFAULT NULL,
  `pub_user_city` varchar(100) DEFAULT NULL,
  `is_claimed` enum('y','n') NOT NULL DEFAULT 'n',
  PRIMARY KEY (`pb_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='public user entry' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pb_lms_user`
--

CREATE TABLE IF NOT EXISTS `tb_pb_lms_user` (
  `pb_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `pb_user_type` enum('STD','ADM','EMP') NOT NULL DEFAULT 'STD',
  `pb_first_name` varchar(200) NOT NULL,
  `pb_last_name` varchar(50) NOT NULL,
  `pb_user_email` varchar(100) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `pb_user_contact` varchar(20) NOT NULL,
  `pb_crt_on` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `status` enum('a','i') NOT NULL DEFAULT 'a',
  `pub_user_qualif` varchar(200) DEFAULT NULL,
  `pub_user_college` varchar(200) DEFAULT NULL,
  `pub_user_stream` varchar(200) DEFAULT NULL,
  `pub_user_city` varchar(100) DEFAULT NULL,
  `is_claimed` enum('y','n') NOT NULL DEFAULT 'n',
  PRIMARY KEY (`pb_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='public user entry' AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pb_lms_user_ass_atmt`
--

CREATE TABLE IF NOT EXISTS `tb_pb_lms_user_ass_atmt` (
  `pb_as_atmid` int(11) NOT NULL AUTO_INCREMENT,
  `pb_user_id` int(11) NOT NULL,
  `ass_id` int(11) NOT NULL,
  `pb_ip_address` varchar(20) DEFAULT NULL,
  `pb_attempt_on` datetime NOT NULL,
  `pb_browser_name` varchar(200) NOT NULL,
  `pb_exit_mode` enum('ui','sq','te') NOT NULL DEFAULT 'ui' COMMENT 'ui-user interuption, sq-selft quit, te- time ends',
  `is_pb_cert_print` enum('y','n') NOT NULL DEFAULT 'n',
  `cert_no` int(11) NOT NULL,
  PRIMARY KEY (`pb_as_atmid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='pub user assessment entry (attempt)' AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pb_lms_user_ass_atmt_hand`
--

CREATE TABLE IF NOT EXISTS `tb_pb_lms_user_ass_atmt_hand` (
  `pb_atm_hand_id` int(11) NOT NULL AUTO_INCREMENT,
  `pb_as_atmid` int(11) NOT NULL,
  `qstn_id` int(11) NOT NULL,
  `qst_opt_id` int(11) DEFAULT NULL,
  `user_space` text,
  `pb_is_review` enum('y','n') NOT NULL DEFAULT 'n',
  `pb_opt_on` datetime NOT NULL,
  PRIMARY KEY (`pb_atm_hand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=240 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
