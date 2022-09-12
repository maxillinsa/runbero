-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 07, 2018 at 12:29 PM
-- Server version: 5.6.17
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `prodms`
--

-- --------------------------------------------------------

--
-- Table structure for table `dms_companies`
--

CREATE TABLE IF NOT EXISTS `dms_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dms_companies`
--

INSERT INTO `dms_companies` (`id`, `name`, `website`, `mobile`, `email`, `contact_person`, `address`, `date_created`, `status`) VALUES
(1, 'Hayes Bank PLC', 'aiicoimsurance.com', '08066405658', 'info@hayebank.com', 'AKinyemi Olusegun', 'Plot B1, Ibadan Road, Lagos', '2018-08-29 09:55:07', 'Y'),
(2, 'NADEC', 'nadec.com', '092348284234', 'segun1.akinyemi@gmail.com', 'John Esqual', 'Plot B2, USA', '2018-08-29 00:00:00', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `params`
--

CREATE TABLE IF NOT EXISTS `params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paramname` varchar(50) NOT NULL,
  `paramvalue` varchar(300) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `params`
--

INSERT INTO `params` (`id`, `paramname`, `paramvalue`, `status`) VALUES
(1, 'baseurl', 'http://localhost/proDMS/', 'Y'),
(2, 'logourl', 'logo.png', 'Y'),
(3, 'docrecnolabel', 'Document Ref', 'Y'),
(4, 'dropoffurl', 'cronosDoc', 'Y'),
(5, 'appname', 'cronosDoc', 'Y'),
(6, 'smtp_host', 'mail.naijadailywork.com', 'Y'),
(7, 'smtp_port', '25', 'Y'),
(8, 'smtp_username', 'admin@naijadailywork.com', 'Y'),
(9, 'smtp_password', 'Samson100@', 'Y'),
(10, 'mime_supported', 'iso,txt,png,jpe,jpeg,jpg,gif,bmp,tiff,tif,zip,pdf,doc,docx,rtf,xsl,xslx,ppt,pptx', 'Y'),
(11, 'max_document_size', '5242880', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `pro_departments`
--

CREATE TABLE IF NOT EXISTS `pro_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `companyid` int(11) DEFAULT NULL,
  `Head` int(11) DEFAULT NULL,
  `shtcode` varchar(10) DEFAULT NULL,
  `deleted` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pro_departments`
--

INSERT INTO `pro_departments` (`id`, `name`, `companyid`, `Head`, `shtcode`, `deleted`) VALUES
(1, 'Customer Service', 1, NULL, 'CST', 'N'),
(2, 'Administration', 2, NULL, 'AD', 'N'),
(3, 'Retails', 1, NULL, 'RT', 'N'),
(4, 'Finance', 1, NULL, 'FN', 'N'),
(5, 'Audit', 1, NULL, 'AU', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `pro_dept_units`
--

CREATE TABLE IF NOT EXISTS `pro_dept_units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `head` int(11) DEFAULT NULL,
  `deptid` int(11) NOT NULL,
  `shtcode` varchar(10) DEFAULT NULL,
  `deleted` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pro_dept_units`
--

INSERT INTO `pro_dept_units` (`id`, `name`, `head`, `deptid`, `shtcode`, `deleted`) VALUES
(1, 'Liquidation', NULL, 1, 'LDT', 'N'),
(2, 'Front Desk', NULL, 1, 'FD', 'N'),
(5, 'Agency', NULL, 3, 'AGN', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `pro_documents`
--

CREATE TABLE IF NOT EXISTS `pro_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `docno` varchar(50) DEFAULT NULL,
  `realname` varchar(100) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `folderid` int(11) DEFAULT NULL,
  `ext` varchar(20) DEFAULT NULL,
  `mimetype` varchar(100) DEFAULT NULL,
  `version` int(11) NOT NULL DEFAULT '1',
  `unit` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `pro_documents`
--

INSERT INTO `pro_documents` (`id`, `name`, `docno`, `realname`, `userid`, `date_created`, `folderid`, `ext`, `mimetype`, `version`, `unit`) VALUES
(1, '8e49d166873eac7b2c14d46dddfc4127.png', 'POL001', 'Capture12.png', 1, '2018-08-31 18:35:06', 36, 'png', 'image/png', 1, 1),
(2, 'c30e720ce41963d5763d3227ecd8ed76.docx', 'POL002', 'MSGBOT.docx', 1, '2018-08-31 19:06:50', 3, 'docx', 'application/msword', 1, 1),
(3, '3d6b42ee90f73f9577c4756a59aa1c80.php', 'POL003', 'index.php', 1, '2018-08-31 19:09:12', 34, 'php', 'text/html', 1, 1),
(4, 'f56b47441795eb1dec79d783100fd97e.pdf', 'POL003', 'FBNI_Investment_RFP.pdf', 1, '2018-09-01 19:05:33', 34, 'pdf', 'application/pdf', 2, 5),
(5, '444d0edb59f4c61a1a5ae1ffdfbf531d.pdf', 'POL003', 'FBNI_Investment_RFP.pdf', 1, '2018-09-01 22:05:27', 34, 'pdf', 'application/pdf', 3, 5),
(6, '5b05b587284e84a5b3f9186ac7b560cf.xls', 'POL004', 'GL_Employee_Upload.xls', 1, '2018-09-02 14:20:58', 3, 'xls', 'application/vnd.ms-excel', 1, 1),
(8, '1df6532e7f7fd0390fbaec7877815336.txt', 'POL005', 'planB.txt', 1, '2018-09-02 18:51:00', 3, 'txt', 'text/plain', 1, 1),
(14, 'e5cc9ee3281cd6a24624b2ee95d80d82.docx', '384839', 'MDReport.docx', 1, '2018-09-04 13:45:47', 1, 'docx', 'application/msword', 1, 1),
(15, '29284a5fb493185adc1687c028a545f8.pdf', 'CRN/0938483/01', 'Hello.pdf', 1, '2018-09-05 11:14:25', 37, 'pdf', 'application/pdf', 1, 1),
(16, 'd7139a2bbb6a5d564e46ea5b2ade0d52.jpg', 'CLMO3003', 'company.jpg', 1, '2018-09-06 15:15:12', 3, 'jpg', 'image/jpeg', 1, 1),
(17, '6f21e569c077081dc773e66ffce85f1b.pdf', 'CRN/0938483/01', 'Hello.pdf', 1, '2018-09-06 15:17:44', 37, 'pdf', 'application/pdf', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pro_doc_schema_data`
--

CREATE TABLE IF NOT EXISTS `pro_doc_schema_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schemaid` int(11) NOT NULL,
  `dataname` varchar(100) DEFAULT NULL,
  `datavalue` varchar(500) DEFAULT NULL,
  `docid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `pro_doc_schema_data`
--

INSERT INTO `pro_doc_schema_data` (`id`, `schemaid`, `dataname`, `datavalue`, `docid`) VALUES
(1, 0, 'Claim No', 'Claim No', 'POL001'),
(2, 0, 'Loss Date', '2018-08-31', 'POL001'),
(3, 0, 'Claim No', '', 'POL002'),
(4, 0, 'Loss Date', '', 'POL002'),
(5, 0, 'Claim No', '', 'POL003'),
(6, 0, 'Loss Date', '', 'POL003'),
(7, 0, 'Claim No', '', 'POL003'),
(8, 0, 'Loss Date', '', 'POL003'),
(9, 0, 'Claim No', 'CLM2001', 'POL003'),
(10, 0, 'Loss Date', '2018-09-01', 'POL003'),
(11, 0, 'Claim No', 'CLM083459', 'POL004'),
(12, 0, 'Loss Date', '2018-09-02', 'POL004'),
(13, 0, 'Premium', '6000', 'POL004'),
(14, 0, 'Claim No', 'CMl03932', 'POL005'),
(15, 0, 'Loss Date', '2018-09-02', 'POL005'),
(16, 0, 'Premium', '2000', 'POL005'),
(17, 0, 'Claim No', '97568458', 'POL005'),
(18, 0, 'Loss Date', '2018-09-02', 'POL005'),
(19, 0, 'Premium', '8000', 'POL005'),
(35, 0, 'Claim No', '9593459', '384839'),
(36, 0, 'Loss Date', '2018-09-04', '384839'),
(37, 0, 'Premium', '10000', '384839'),
(38, 0, 'Claim No', 'CRN/0938483/01', 'CRN/0938483/01'),
(39, 0, 'Loss Date', '2018-09-05', 'CRN/0938483/01'),
(40, 0, 'Premium', '10000', 'CRN/0938483/01'),
(41, 0, 'Claim No', 'GENF20303', 'POL001'),
(42, 0, 'Loss Date', '2018-09-05', 'POL001'),
(43, 0, 'Premium', '220100', 'POL001'),
(44, 0, 'Claim No', 'CLM001', 'CLMO3003'),
(45, 0, 'Loss Date', '2018-09-06', 'CLMO3003'),
(46, 0, 'Premium', '3000000', 'CLMO3003'),
(47, 0, 'Claim No', 'CRN/0938483/01', 'CRN/0938483/01'),
(48, 0, 'Loss Date', '', 'CRN/0938483/01'),
(49, 0, 'Premium', '', 'CRN/0938483/01');

-- --------------------------------------------------------

--
-- Table structure for table `pro_file_discuss`
--

CREATE TABLE IF NOT EXISTS `pro_file_discuss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(2000) DEFAULT NULL,
  `fileid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `ddate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pro_file_discuss`
--

INSERT INTO `pro_file_discuss` (`id`, `comment`, `fileid`, `userid`, `ddate`) VALUES
(1, 'This file is not what you think it is...', 2, 1, '2018-09-03 08:00:25'),
(2, 'Well this is just a test', 2, 1, '2018-09-03 08:23:53'),
(3, '@Akinyemi Olusegun The policy number is POL08485', 2, 1, '2018-09-03 08:29:13'),
(4, 'WHat is this?', 1, 1, '2018-09-04 07:55:44'),
(5, 'File ajfasjaskdasdjasdjakdas', 16, 1, '2018-09-06 15:15:53');

-- --------------------------------------------------------

--
-- Table structure for table `pro_folder`
--

CREATE TABLE IF NOT EXISTS `pro_folder` (
  `name` varchar(100) DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `createdby` varchar(50) DEFAULT NULL,
  `schemaid` int(11) DEFAULT NULL,
  `deleted` varchar(1) NOT NULL DEFAULT 'N',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentfolder` int(11) NOT NULL,
  `public` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `pro_folder`
--

INSERT INTO `pro_folder` (`name`, `datecreated`, `unit`, `createdby`, `schemaid`, `deleted`, `id`, `parentfolder`, `public`) VALUES
('All Payment', '2018-08-30 19:03:03', 1, 'maxillin', 1, 'N', 1, 0, 'N'),
('Visits', '2018-08-31 11:10:58', 2, 'maxillin', 1, 'N', 2, 0, 'N'),
('EFT2016', '2018-08-31 11:45:52', 1, 'maxillin', 1, 'N', 3, 1, 'Y'),
('gerald', '2018-09-01 10:20:36', 1, 'maxillin', 1, 'N', 29, 3, 'Y'),
('Mydoc', '2018-09-01 10:48:21', 1, 'maxillin', 1, 'N', 30, 29, 'N'),
('Commission', '2018-09-01 16:32:07', 5, 'maxillin', 1, 'N', 32, 0, 'N'),
('deductions', '2018-09-01 16:32:42', 5, 'maxillin', 1, 'N', 33, 32, 'N'),
('POL003', '2018-09-01 19:05:33', 5, 'SYS', 1, 'N', 34, 32, 'N'),
('Titmus Chemicals', '2018-09-03 12:57:57', 1, 'maxillin', 1, 'N', 36, 0, 'N'),
('CRN/0938483/01', '2018-09-06 15:17:44', 1, 'SYS', 1, 'N', 37, 30, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `pro_instage`
--

CREATE TABLE IF NOT EXISTS `pro_instage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) DEFAULT NULL,
  `usern` varchar(50) DEFAULT NULL,
  `ext` varchar(10) DEFAULT NULL,
  `realname` varchar(300) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `pro_instage`
--

INSERT INTO `pro_instage` (`id`, `name`, `usern`, `ext`, `realname`, `date_created`) VALUES
(1, '5e68389df438539a5e3963a12db72d62.png', 'maxillin', 'png', 'Capture12.png', '2018-09-06 08:04:21'),
(2, 'd7139a2bbb6a5d564e46ea5b2ade0d52.jpg', 'maxillin', 'jpg', 'company.jpg', '2018-09-06 15:14:14'),
(3, '4cb3de30ac79886ec25af79e11660981.docx', 'maxillin', 'docx', 'Hello.docx', '2018-09-06 15:16:41'),
(4, '6f21e569c077081dc773e66ffce85f1b.pdf', 'maxillin', 'pdf', 'Hello.pdf', '2018-09-06 15:16:57'),
(5, 'f1fa4149e6e4e49172ccf3be5b8a160b.pdf', 'maxillin', 'pdf', 'Hello.pdf', '2018-09-06 16:00:23'),
(6, '6555e3e5d166298d281327af8295f477.zip', 'maxillin', 'zip', 'RMX1000Plugin212exe.zip', '2018-09-07 10:37:09'),
(7, 'f8c4b31443fc0f66996a83d011b2029e.pdf', 'maxillin', 'pdf', 'FBNI WELFARE PROPOSAL FORM cleaned (1).pdf', '2018-09-07 10:46:06');

-- --------------------------------------------------------

--
-- Table structure for table `pro_log`
--

CREATE TABLE IF NOT EXISTS `pro_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(1000) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `ddate` datetime DEFAULT NULL,
  `fileid` int(11) DEFAULT NULL,
  `folderid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `pro_log`
--

INSERT INTO `pro_log` (`id`, `comment`, `userid`, `ddate`, `fileid`, `folderid`) VALUES
(1, 'Opened file 20180227_FBN Insurance scan.xlsx', 1, '2018-09-03 12:57:23', 10, 0),
(2, 'Created Folder Litmus', 1, '2018-09-03 12:57:57', 0, 36),
(3, 'Deleted file 20180227_FBN Insurance scan.xlsx', 1, '2018-09-03 12:58:21', 10, 0),
(4, 'Renamed Folder Litmus Test to ', 1, '2018-09-03 12:59:15', 0, 36),
(5, 'Renamed Folder Titmus Chemicals to Titmus Chemicals', 1, '2018-09-03 13:01:31', 0, 36),
(6, 'Deleted file exitreport.xlsx', 1, '2018-09-04 13:43:44', 12, 0),
(7, 'Deleted file Premia_Contract_Review.docx', 1, '2018-09-04 13:45:01', 13, 0),
(8, 'Deleted file Retirement Tips- How to create your own Personal Pension Plan.mp4', 1, '2018-09-04 13:45:04', 11, 0),
(9, 'Edited Company AIICO Insurance', 1, '2018-09-05 12:20:49', 0, 0),
(10, 'Edited Department Customer Service', 1, '2018-09-05 12:21:21', 0, 0),
(11, 'Edited Unit Liquidation', 1, '2018-09-05 12:21:40', 0, 0),
(12, 'Edited user account for Akinyemi Samson', 1, '2018-09-05 13:09:41', 0, 0),
(13, 'Edited user account for Akinyemi Samson', 1, '2018-09-05 13:12:18', 0, 0),
(14, 'Edited user account for Akinyemi Samson', 1, '2018-09-05 13:13:10', 0, 0),
(15, 'Edited metadata field for Claim Number', 1, '2018-09-05 13:32:43', 0, 0),
(16, 'Edited metadata field for Claim No', 1, '2018-09-05 13:33:34', 0, 0),
(17, 'Opened file Capture12.png', 1, '2018-09-05 13:51:08', 1, 0),
(18, 'Opened file MDReport.docx', 1, '2018-09-05 14:48:16', 14, 0),
(19, 'Opened file MDReport.docx', 1, '2018-09-05 14:48:22', 14, 0),
(20, 'Opened file MDReport.docx', 1, '2018-09-05 14:48:50', 14, 0),
(21, 'Opened file MDReport.docx', 1, '2018-09-05 14:48:56', 14, 0),
(22, 'Opened file MDReport.docx', 1, '2018-09-05 14:49:53', 14, 0),
(23, 'Opened file MDReport.docx', 1, '2018-09-05 14:52:12', 14, 0),
(24, 'Opened file Hello.pdf', 1, '2018-09-05 14:52:43', 15, 0),
(25, 'Opened file MDReport.docx', 1, '2018-09-05 14:55:16', 14, 0),
(26, 'Opened file MDReport.docx', 1, '2018-09-05 14:56:39', 14, 0),
(27, 'Opened file MDReport.docx', 1, '2018-09-05 14:59:48', 14, 0),
(28, 'Opened file Hello.pdf', 1, '2018-09-05 15:00:20', 15, 0),
(29, 'Opened file Hello.pdf', 1, '2018-09-05 15:00:28', 15, 0),
(30, 'Opened file Hello.pdf', 1, '2018-09-05 15:00:48', 15, 0),
(31, 'Created User Adeola Bunmi', 1, '2018-09-06 09:28:50', 0, 0),
(32, 'Opened file Hello.pdf', 1, '2018-09-06 15:18:03', 15, 0),
(33, 'Opened file Hello.pdf', 1, '2018-09-06 18:17:57', 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pro_perm_folder_dept`
--

CREATE TABLE IF NOT EXISTS `pro_perm_folder_dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folderid` int(11) NOT NULL,
  `deptid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `deleted` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `pro_perm_folder_dept`
--

INSERT INTO `pro_perm_folder_dept` (`id`, `folderid`, `deptid`, `cid`, `deleted`) VALUES
(1, 1, 5, 1, 'Y'),
(2, 1, 4, 1, 'Y'),
(3, 1, 3, 1, 'Y'),
(4, 1, 1, 1, 'Y'),
(5, 1, 5, 1, 'Y'),
(6, 1, 5, 1, 'Y'),
(7, 1, 5, 1, 'Y'),
(8, 1, 5, 1, 'Y'),
(9, 1, 5, 1, 'Y'),
(10, 1, 5, 1, 'N'),
(11, 1, 1, 1, 'N'),
(12, 2, 1, 1, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `pro_perm_folder_dept_users`
--

CREATE TABLE IF NOT EXISTS `pro_perm_folder_dept_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folderid` int(11) NOT NULL,
  `deptid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `deleted` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pro_perm_folder_dept_users`
--

INSERT INTO `pro_perm_folder_dept_users` (`id`, `folderid`, `deptid`, `userid`, `deleted`) VALUES
(1, 1, 1, 1, 'N'),
(4, 2, 1, 1, 'N'),
(5, 1, 1, 2, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `pro_perm_folder_dept_users_roles`
--

CREATE TABLE IF NOT EXISTS `pro_perm_folder_dept_users_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deptid` int(11) NOT NULL,
  `folderid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `canshare` varchar(1) NOT NULL DEFAULT 'N',
  `candelete` varchar(1) NOT NULL DEFAULT 'N',
  `canread` varchar(1) NOT NULL DEFAULT 'Y',
  `canwrite` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pro_perm_folder_dept_users_roles`
--

INSERT INTO `pro_perm_folder_dept_users_roles` (`id`, `deptid`, `folderid`, `userid`, `canshare`, `candelete`, `canread`, `canwrite`) VALUES
(2, 1, 1, 1, 'N', 'Y', 'N', 'N'),
(3, 1, 2, 1, 'N', 'N', 'N', 'Y'),
(4, 1, 1, 2, 'N', 'Y', 'Y', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `pro_products`
--

CREATE TABLE IF NOT EXISTS `pro_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` varchar(100) DEFAULT NULL,
  `companyid` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pro_products`
--

INSERT INTO `pro_products` (`id`, `product`, `companyid`, `date_created`) VALUES
(1, 'Cash Accumulation Plan', 1, '2018-08-29 14:31:20');

-- --------------------------------------------------------

--
-- Table structure for table `pro_schema`
--

CREATE TABLE IF NOT EXISTS `pro_schema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `unitid` int(11) DEFAULT NULL,
  `compid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pro_schema`
--

INSERT INTO `pro_schema` (`id`, `name`, `description`, `unitid`, `compid`) VALUES
(1, 'Claims Schema', 'Schema for all claims related files', 1, 1),
(2, 'dasjda', 'asldlas', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pro_schema_fields`
--

CREATE TABLE IF NOT EXISTS `pro_schema_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schemaid` int(11) DEFAULT NULL,
  `fieldname` varchar(100) DEFAULT NULL,
  `datatype` varchar(50) DEFAULT NULL,
  `datasize` int(11) DEFAULT NULL,
  `createdby` varchar(100) DEFAULT NULL,
  `indexkey` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pro_schema_fields`
--

INSERT INTO `pro_schema_fields` (`id`, `schemaid`, `fieldname`, `datatype`, `datasize`, `createdby`, `indexkey`) VALUES
(1, 1, 'Claim No', 'varcharo', 21, '2018-08-29 14:38:31', 'Y'),
(2, 1, 'Loss Date', 'dateo', 20, '2018-08-29 14:39:13', 'N'),
(3, 1, 'Premium', 'numbero', 20, 'maxillin', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `pro_users`
--

CREATE TABLE IF NOT EXISTS `pro_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usern` varchar(50) DEFAULT NULL,
  `Fullname` varchar(100) DEFAULT NULL,
  `pword` varchar(2000) DEFAULT NULL,
  `deptid` int(11) DEFAULT NULL,
  `unitid` int(11) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `active` varchar(10) DEFAULT 'Y',
  `compid` int(11) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pro_users`
--

INSERT INTO `pro_users` (`id`, `usern`, `Fullname`, `pword`, `deptid`, `unitid`, `email`, `active`, `compid`, `usertype`) VALUES
(1, 'maxillin', 'Akinyemi Samson', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 1, 'segun1.akinyemi@gmail.com', 'Y', 1, 'superadmin'),
(2, 'maxido', 'Ajeleke Dada', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 1, 'maxido@gmail.com', 'Y', 1, 'admin'),
(4, 'SYS', 'SYSTEM', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 1, NULL, 'Y', 0, 'superadmin'),
(5, 'ade', 'Adeola Bunmi', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 1, 'ade@gm.com', 'Y', 1, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `pro_user_tasks`
--

CREATE TABLE IF NOT EXISTS `pro_user_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `done` varchar(1) NOT NULL DEFAULT 'N',
  `taskid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `assignedby` int(11) NOT NULL,
  `fileid` int(11) NOT NULL,
  `donecomment` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pro_user_tasks`
--

INSERT INTO `pro_user_tasks` (`id`, `done`, `taskid`, `userid`, `assignedby`, `fileid`, `donecomment`) VALUES
(1, 'Y', 1, 1, 1, 3, 'asdadds'),
(2, 'N', 3, 2, 1, 3, ''),
(3, 'N', 1, 2, 1, 15, ''),
(4, 'N', 3, 2, 1, 16, ''),
(5, 'N', 4, 5, 1, 17, '');

-- --------------------------------------------------------

--
-- Table structure for table `pro_workflow_def`
--

CREATE TABLE IF NOT EXISTS `pro_workflow_def` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deptid` int(11) NOT NULL,
  `taskname` varchar(150) DEFAULT NULL,
  `task_description` varchar(2000) DEFAULT NULL,
  `task_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pro_workflow_def`
--

INSERT INTO `pro_workflow_def` (`id`, `deptid`, `taskname`, `task_description`, `task_order`) VALUES
(1, 1, 'Review', 'Just review the document', 1),
(3, 1, 'Add Policy Document', 'Add Policy Document', 2),
(4, 1, 'Check KYC', 'Check to know if all KYC data are provided correctly', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbltasks`
--

CREATE TABLE IF NOT EXISTS `tbltasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taskname` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbltasks`
--

