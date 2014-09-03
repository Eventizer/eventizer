-- phpMyAdmin SQL Dump
-- version 4.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 21, 2014 at 03:00 PM
-- Server version: 5.5.31
-- PHP Version: 5.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `web_dev_framework`
--
CREATE DATABASE IF NOT EXISTS `web_dev_framework` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `web_dev_framework`;

-- --------------------------------------------------------

--
-- Table structure for table `lh_abstract_country`
--

CREATE TABLE IF NOT EXISTS `lh_abstract_country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `iso_code` varchar(3) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=245 ;

--
-- Dumping data for table `lh_abstract_country`
--

INSERT INTO `lh_abstract_country` (`id`, `name`, `iso_code`, `position`) VALUES
(1, 'Afghanistan', 'AF', 0),
(2, 'Åland Islands', 'AX', 0),
(3, 'Albania', 'AL', 0),
(4, 'Algeria', 'DZ', 0),
(5, 'American Samoa', 'AS', 0),
(6, 'Andorra', 'AD', 0),
(7, 'Angola', 'AO', 0),
(8, 'Anguilla', 'AI', 0),
(10, 'Antigua and Barbuda', 'AG', 0),
(11, 'Argentina', 'AR', 0),
(12, 'Armenia', 'AM', 0),
(13, 'Aruba', 'AW', 0),
(14, 'Australia', 'AU', 0),
(15, 'Austria', 'AT', 0),
(16, 'Azerbaijan', 'AZ', 0),
(17, 'Bahamas', 'BS', 0),
(18, 'Bahrain', 'BH', 0),
(19, 'Bangladesh', 'BD', 0),
(20, 'Barbados', 'BB', 0),
(21, 'Belarus', 'BY', 0),
(22, 'Belgium', 'BE', 0),
(23, 'Belize', 'BZ', 0),
(24, 'Benin', 'BJ', 0),
(25, 'Bermuda', 'BM', 0),
(26, 'Bhutan', 'BT', 0),
(27, 'Bolivia', 'BO', 0),
(28, 'Bosnia and Herzegovina', 'BA', 0),
(29, 'Botswana', 'BW', 0),
(30, 'Bouvet Island', 'BV', 0),
(31, 'Brazil', 'BR', 0),
(33, 'Brunei', 'BN', 0),
(34, 'Bulgaria', 'BG', 0),
(35, 'Burkina Faso', 'BF', 0),
(36, 'Burma (Myanmar)', 'MM', 0),
(37, 'Burundi', 'BI', 0),
(38, 'Cambodia', 'KH', 0),
(39, 'Cameroon', 'CM', 0),
(40, 'Canada', 'CA', 0),
(41, 'Cape Verde', 'CV', 0),
(42, 'Cayman Islands', 'KY', 0),
(43, 'Central African Republic', 'CF', 0),
(44, 'Chad', 'TD', 0),
(45, 'Chile', 'CL', 0),
(46, 'China', 'CN', 0),
(47, 'Christmas Island', 'CX', 0),
(48, 'Cocos (Keeling) Islands', 'CC', 0),
(49, 'Colombia', 'CO', 0),
(50, 'Comoros', 'KM', 0),
(51, 'Congo, Dem. Republic', 'CD', 0),
(52, 'Congo, Republic', 'CG', 0),
(53, 'Cook Islands', 'CK', 0),
(54, 'Costa Rica', 'CR', 0),
(55, 'Croatia', 'HR', 0),
(56, 'Cuba', 'CU', 0),
(57, 'Cyprus', 'CY', 0),
(58, 'Czech Republic', 'CZ', 0),
(59, 'Denmark', 'DK', 0),
(60, 'Djibouti', 'DJ', 0),
(61, 'Dominica', 'DM', 0),
(63, 'East Timor', 'TL', 0),
(64, 'Ecuador', 'EC', 0),
(65, 'Egypt', 'EG', 0),
(66, 'El Salvador', 'SV', 0),
(67, 'Equatorial Guinea', 'GQ', 0),
(68, 'Eritrea', 'ER', 0),
(69, 'Estonia', 'EE', 0),
(70, 'Ethiopia', 'ET', 0),
(71, 'Falkland Islands', 'FK', 0),
(72, 'Faroe Islands', 'FO', 0),
(73, 'Fiji', 'FJ', 0),
(74, 'Finland', 'FI', 0),
(75, 'France', 'FR', 0),
(79, 'Gabon', 'GA', 0),
(80, 'Gambia', 'GM', 0),
(81, 'Georgia', 'GE', 0),
(82, 'Germany', 'DE', 0),
(83, 'Ghana', 'GH', 0),
(84, 'Gibraltar', 'GI', 0),
(85, 'Greece', 'GR', 0),
(86, 'Greenland', 'GL', 0),
(87, 'Grenada', 'GD', 0),
(88, 'Guadeloupe', 'GP', 0),
(89, 'Guam', 'GU', 0),
(90, 'Guatemala', 'GT', 0),
(91, 'Guernsey', 'GG', 0),
(92, 'Guinea', 'GN', 0),
(93, 'Guinea-Bissau', 'GW', 0),
(94, 'Guyana', 'GY', 0),
(95, 'Haiti', 'HT', 0),
(97, 'Honduras', 'HN', 0),
(99, 'Hungary', 'HU', 0),
(100, 'Iceland', 'IS', 0),
(101, 'India', 'IN', 0),
(102, 'Indonesia', 'ID', 0),
(103, 'Iran', 'IR', 0),
(104, 'Iraq', 'IQ', 0),
(105, 'Ireland', 'IE', 0),
(106, 'Israel', 'IL', 0),
(107, 'Italy', 'IT', 0),
(108, 'Ivory Coast', 'CI', 0),
(109, 'Jamaica', 'JM', 0),
(110, 'Japan', 'JP', 0),
(111, 'Jersey', 'JE', 0),
(112, 'Jordan', 'JO', 0),
(113, 'Kazakhstan', 'KZ', 0),
(114, 'Kenya', 'KE', 0),
(115, 'Kiribati', 'KI', 0),
(116, 'Korea, Dem. Republic ', 'KP', 0),
(117, 'Kuwait', 'KW', 0),
(118, 'Kyrgyzstan', 'KG', 0),
(119, 'Laos', 'LA', 0),
(120, 'Latvia', 'LV', 0),
(121, 'Lebanon', 'LB', 0),
(122, 'Lesotho', 'LS', 0),
(123, 'Liberia', 'LR', 0),
(124, 'Libya', 'LY', 0),
(125, 'Liechtenstein', 'LI', 0),
(126, 'Lithuania', 'LT', 0),
(127, 'Luxemburg', 'LU', 0),
(128, 'Macau', 'MO', 0),
(129, 'Macedonia', 'MK', 0),
(130, 'Madagascar', 'MG', 0),
(131, 'Malawi', 'MW', 0),
(132, 'Malaysia', 'MY', 0),
(133, 'Maldives', 'MV', 0),
(134, 'Mali', 'ML', 0),
(135, 'Malta', 'MT', 0),
(136, 'Man Island', 'IM', 0),
(137, 'Marshall Islands', 'MH', 0),
(138, 'Martinique', 'MQ', 0),
(139, 'Mauritania', 'MR', 0),
(140, 'Mauritius', 'MU', 0),
(141, 'Mayotte', 'YT', 0),
(142, 'Mexico', 'MX', 0),
(143, 'Micronesia', 'FM', 0),
(144, 'Moldova', 'MD', 0),
(145, 'Monaco', 'MC', 0),
(146, 'Mongolia', 'MN', 0),
(147, 'Montenegro', 'ME', 0),
(148, 'Montserrat', 'MS', 0),
(149, 'Morocco', 'MA', 0),
(150, 'Mozambique', 'MZ', 0),
(151, 'Namibia', 'NA', 0),
(152, 'Nauru', 'NR', 0),
(153, 'Nepal', 'NP', 0),
(154, 'Netherlands', 'NL', 0),
(155, 'Netherlands Antilles', 'AN', 0),
(156, 'New Caledonia', 'NC', 0),
(157, 'New Zealand', 'NZ', 0),
(158, 'Nicaragua', 'NI', 0),
(159, 'Niger', 'NE', 0),
(160, 'Nigeria', 'NG', 0),
(161, 'Niue', 'NU', 0),
(162, 'Norfolk Island', 'NF', 0),
(163, 'Northern Mariana Islands', 'MP', 0),
(164, 'Norway', 'NO', 0),
(165, 'Oman', 'OM', 0),
(166, 'Pakistan', 'PK', 0),
(167, 'Palau', 'PW', 0),
(168, 'Palestinian Territories', 'PS', 0),
(169, 'Panama', 'PA', 0),
(170, 'Papua New Guinea', 'PG', 0),
(171, 'Paraguay', 'PY', 0),
(172, 'Peru', 'PE', 0),
(173, 'Philippines', 'PH', 0),
(174, 'Pitcairn', 'PN', 0),
(175, 'Poland', 'PL', 0),
(176, 'Portugal', 'PT', 0),
(177, 'Puerto Rico', 'PR', 0),
(178, 'Qatar', 'QA', 0),
(179, 'Reunion Island', 'RE', 0),
(180, 'Romania', 'RO', 0),
(181, 'Russian Federation', 'RU', 0),
(182, 'Rwanda', 'RW', 0),
(183, 'Saint Barthelemy', 'BL', 0),
(184, 'Saint Kitts and Nevis', 'KN', 0),
(185, 'Saint Lucia', 'LC', 0),
(186, 'Saint Martin', 'MF', 0),
(187, 'Saint Pierre and Miquelon', 'PM', 0),
(188, 'Saint Vincent and the Grenadines', 'VC', 0),
(189, 'Samoa', 'WS', 0),
(190, 'San Marino', 'SM', 0),
(191, 'São Tomé and Príncipe', 'ST', 0),
(192, 'Saudi Arabia', 'SA', 0),
(193, 'Senegal', 'SN', 0),
(194, 'Serbia', 'RS', 0),
(195, 'Seychelles', 'SC', 0),
(196, 'Sierra Leone', 'SL', 0),
(197, 'Singapore', 'SG', 0),
(198, 'Slovakia', 'SK', 0),
(199, 'Slovenia', 'SI', 0),
(200, 'Solomon Islands', 'SB', 0),
(201, 'Somalia', 'SO', 0),
(202, 'South Africa', 'ZA', 0),
(203, 'South Georgia and the South Sandwich Islands', 'GS', 0),
(204, 'South Korea', 'KR', 0),
(205, 'Spain', 'ES', 0),
(206, 'Sri Lanka', 'LK', 0),
(207, 'Sudan', 'SD', 0),
(208, 'Suriname', 'SR', 0),
(209, 'Svalbard and Jan Mayen', 'SJ', 0),
(210, 'Swaziland', 'SZ', 0),
(211, 'Sweden', 'SE', 0),
(212, 'Switzerland', 'CH', 0),
(213, 'Syria', 'SY', 0),
(214, 'Taiwan', 'TW', 0),
(215, 'Tajikistan', 'TJ', 0),
(216, 'Tanzania', 'TZ', 0),
(217, 'Thailand', 'TH', 0),
(218, 'Togo', 'TG', 0),
(219, 'Tokelau', 'TK', 0),
(220, 'Tonga', 'TO', 0),
(221, 'Trinidad and Tobago', 'TT', 0),
(222, 'Tunisia', 'TN', 0),
(223, 'Turkey', 'TR', 0),
(224, 'Turkmenistan', 'TM', 0),
(226, 'Tuvalu', 'TV', 0),
(227, 'Uganda', 'UG', 0),
(228, 'Ukraine', 'UA', 0),
(229, 'United Arab Emirates', 'AE', 0),
(230, 'United Kingdom', 'GB', 1),
(231, 'United States', 'US', 0),
(232, 'Uruguay', 'UY', 0),
(233, 'Uzbekistan', 'UZ', 0),
(234, 'Vanuatu', 'VU', 0),
(235, 'Vatican City State', 'VA', 0),
(236, 'Venezuela', 'VE', 0),
(237, 'Vietnam', 'VN', 0),
(242, 'Yemen', 'YE', 0),
(243, 'Zambia', 'ZM', 0),
(244, 'Zimbabwe', 'ZW', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lh_abstract_email_templates`
--

CREATE TABLE IF NOT EXISTS `lh_abstract_email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `subject_en_en` text NOT NULL,
  `content_en_en` text NOT NULL,
  `from_name` varchar(250) NOT NULL,
  `from_email` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `lh_abstract_email_templates`
--

INSERT INTO `lh_abstract_email_templates` (`id`, `name`, `subject_en_en`, `content_en_en`, `from_name`, `from_email`) VALUES
(1, 'Password Reset Request', 'Password Reset Request', 'Dear {name} {surname},\r\n\r\nThere was recently a request to change the password on your user profile.\r\n\r\nIf you requested this password change, please <a href="{url_recovery}">click here</a> to reset your password.', 'Demo', 'noreply@coral.lt'),
(2, 'New password request', 'New password request', 'Dear {name} {surname},\r\n\r\nYour new password is: {new_password}', 'Demo', 'noreply@coral.lt'),
(3, 'Registration activate', 'Registration activate', 'Dear {name} {surname},\r\n\r\nTo activate your account click link below:\r\n\r\n<a href="{url_confirm}">Click here</a>', 'Demo', 'noreply@coral.lt'),
(4, 'Registration complete', 'Registration complete', 'Dear {name} {surname},\r\n\r\nYou have successfully activated an account.', 'Demo', 'noreply@coral.lt');

-- --------------------------------------------------------

--
-- Table structure for table `lh_abstract_url_alias`
--

CREATE TABLE IF NOT EXISTS `lh_abstract_url_alias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url_alias` varchar(100) NOT NULL,
  `url_destination_en_en` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lh_article`
--

CREATE TABLE IF NOT EXISTS `lh_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en_en` varchar(250) NOT NULL,
  `intro_en_en` text NOT NULL,
  `body_en_en` text NOT NULL,
  `alias_url_en_en` varchar(150) NOT NULL,
  `alternative_url_en_en` varchar(150) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_id_parent` int(11) NOT NULL,
  `has_photo` tinyint(4) NOT NULL,
  `pos` int(11) NOT NULL DEFAULT '0',
  `open_new_page` tinyint(4) NOT NULL,
  `hide` tinyint(4) NOT NULL,
  `system` tinyint(4) NOT NULL,
  `mtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lh_article_category`
--

CREATE TABLE IF NOT EXISTS `lh_article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en_en` varchar(100) NOT NULL,
  `intro_en_en` text NOT NULL,
  `url_alternative_en_en` varchar(100) NOT NULL,
  `parent_id` mediumint(9) NOT NULL,
  `pos` int(11) NOT NULL,
  `system` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lh_article_static`
--

CREATE TABLE IF NOT EXISTS `lh_article_static` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en_en` varchar(200) NOT NULL,
  `content_en_en` text NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `mtime` int(11) NOT NULL,
  `system` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lh_cron_mailer_mail`
--

CREATE TABLE IF NOT EXISTS `lh_cron_mailer_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `send_time` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email_subject` varchar(250) NOT NULL,
  `email_content` text NOT NULL,
  `params` varchar(250) NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lh_forgotpasswordhash`
--

CREATE TABLE IF NOT EXISTS `lh_forgotpasswordhash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lh_group`
--

CREATE TABLE IF NOT EXISTS `lh_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `system` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lh_group`
--

INSERT INTO `lh_group` (`id`, `name`, `system`) VALUES
(1, 'Administrators', 1),
(2, 'Registered users', 1),
(3, 'Anonymous users', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lh_grouprole`
--

CREATE TABLE IF NOT EXISTS `lh_grouprole` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`role_id`,`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `lh_grouprole`
--

INSERT INTO `lh_grouprole` (`id`, `group_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(4, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `lh_groupuser`
--

CREATE TABLE IF NOT EXISTS `lh_groupuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`),
  KEY `group_id_2` (`group_id`,`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lh_groupuser`
--

INSERT INTO `lh_groupuser` (`id`, `group_id`, `user_id`) VALUES
(1, 1, 1),
(2, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `lh_role`
--

CREATE TABLE IF NOT EXISTS `lh_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `system` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lh_role`
--

INSERT INTO `lh_role` (`id`, `name`, `system`) VALUES
(1, 'Administrators', 1),
(2, 'Registered users', 1),
(3, 'Anonymous users', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lh_rolefunction`
--

CREATE TABLE IF NOT EXISTS `lh_rolefunction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `module` varchar(100) NOT NULL,
  `function` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lh_rolefunction`
--

INSERT INTO `lh_rolefunction` (`id`, `role_id`, `module`, `function`) VALUES
(1, 1, '*', '*'),
(2, 2, 'lhuser', 'selfedit');

-- --------------------------------------------------------

--
-- Table structure for table `lh_system_config`
--

CREATE TABLE IF NOT EXISTS `lh_system_config` (
  `identifier` varchar(50) NOT NULL,
  `value` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `explain` varchar(250) NOT NULL,
  `hidden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lh_system_config`
--

INSERT INTO `lh_system_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES
('allowed_file_types', '*.jpg;*.gif;*.png;*.png;*.bmp;*.ogv;*.swf;*.mpeg;*.avi;*.mpg;*.wmv', 0, 'List of allowed file types to upload', 0),
('file_queue_limit', '20', 0, 'How many files user can upload in single session', 0),
('file_upload_limit', '200', 0, 'How many files upload during one session', 0),
('full_image_quality', '93', 0, 'Full image quality', 0),
('max_archive_size', '20480', 0, 'Maximum archive size in kilobytes', 0),
('max_photo_size', '5120', 0, 'Maximum photo size in kilobytes', 0),
('normal_thumbnail_quality', '93', 0, 'Converted normal thumbnail quality', 0),
('normal_thumbnail_width_x', '400', 0, 'Normal size thumbnail width - x', 0),
('normal_thumbnail_width_y', '400', 0, 'Normal size thumbnail width - y', 0),
('smtp_data', 'a:5:{s:4:"host";s:13:"mail.coral.lt";s:4:"port";s:2:"25";s:8:"use_smtp";i:0;s:8:"username";s:0:"";s:8:"password";s:5:"dfgdf";}', 0, 'SMTP configuration', 1),
('thumbnail_quality_default', '93', 0, 'Converted small thumbnail image quality', 0),
('thumbnail_scale_algorithm', 'croppedThumbnail', 0, 'It can be "scale" or "croppedThumbnail" - makes perfect squares, or "croppedThumbnailTop" makes perfect squares, image cropped from top', 0),
('thumbnail_width_x', '120', 0, 'Small thumbnail width - x', 0),
('thumbnail_width_y', '130', 0, 'Small thumbnail width - Y', 0),
('watermark_data', 'a:9:{s:17:"watermark_enabled";b:0;s:21:"watermark_enabled_all";b:0;s:9:"watermark";s:0:"";s:6:"size_x";i:200;s:6:"size_y";i:50;s:18:"watermark_disabled";b:1;s:18:"watermark_position";s:12:"bottom_right";s:28:"watermark_position_padding_x";i:10;s:28:"watermark_position_padding_y";i:10;}', 0, 'Not shown public, editing is done in watermark module', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lh_users`
--

CREATE TABLE IF NOT EXISTS `lh_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `disabled` tinyint(4) NOT NULL,
  `lastactivity` int(11) NOT NULL,
  `time_zone` varchar(200) NOT NULL,
  `activate_hash` varchar(200) NOT NULL,
  `system` tinyint(4) NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `system` (`system`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lh_users`
--

INSERT INTO `lh_users` (`id`, `password`, `email`, `name`, `surname`, `disabled`, `lastactivity`, `time_zone`, `activate_hash`, `system`, `created`) VALUES
(1, 'e97067020e4683d151d141764d40d01d0d8d96d5', 'martynasb@coral.lt', 'Admin', 'Admin', 0, 1400669634, '', '', 1, 0),
(2, 'aa716a1cb67af5958580a5a3342a6ec924db7026', 'anonymous@coral.lt', 'Anonymous', 'Anonymous', 0, 0, '', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lh_users_remember`
--

CREATE TABLE IF NOT EXISTS `lh_users_remember` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
