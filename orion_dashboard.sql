SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Table structure for table `linkaggregator`
--
CREATE TABLE IF NOT EXISTS `linkaggregator` (
  `id` int(3) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IP` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `name` varchar(255) NOT NULL,
  `url` varchar(300) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '0',
  `hash` varchar(4) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `map_shortcuts`
--

CREATE TABLE IF NOT EXISTS `map_shortcuts` (
  `name` varchar(20) NOT NULL,
  `x_pos` int(4) NOT NULL,
  `z_pos` int(4) NOT NULL,
  `zoom` varchar(3) NOT NULL,
  `display_order` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `navbar`
--

CREATE TABLE IF NOT EXISTS `navbar` (
  `name` varchar(32) NOT NULL,
  `id` int(4) NOT NULL,
  `url` text NOT NULL,
  `target` varchar(32) NOT NULL DEFAULT '_self',
  `icon` varchar(64) NOT NULL,
  `alignment` char(1) NOT NULL,
  `link_order` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL,
  `owner` varchar(32) NOT NULL,
  `content` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mc_username` varchar(255) NOT NULL,
  `mc_avatar` varchar(255) NOT NULL,
  `privilage` int(1) NOT NULL DEFAULT '0',
  `account_approved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE IF NOT EXISTS `user_sessions` (
  `cookie` varchar(64) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `issues_list`
--

CREATE TABLE IF NOT EXISTS `issues_list` (
  `IssueId` varchar(32) NOT NULL COMMENT 'Primary Key.',
  `Name` varchar(255) NOT NULL COMMENT 'A name for the task.',
  `URL` varchar(2083) NOT NULL COMMENT 'IE URL limit.',
  `IsActive` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Is it worth caring about?',
  `Status` varchar(32) NOT NULL COMMENT 'Foreign key to a status table.',
  `Notes` text NOT NULL,
  `ProjectId` int(11) NOT NULL COMMENT 'Primary Key.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `issues_projects` (
  `ProjectId` int(11) NOT NULL,
  `OwnerId` varchar(32) NOT NULL,
  `Name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status_options`
--

CREATE TABLE IF NOT EXISTS `status_options` (
  `status` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `linkaggregator`
--
ALTER TABLE `linkaggregator`
  ADD PRIMARY KEY IF NOT EXISTS (`id`),
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- Indexes for table `map_shortcuts`
--
ALTER TABLE `map_shortcuts`
  ADD PRIMARY KEY IF NOT EXISTS (`name`);

--
-- Indexes for table `navbar`
--
ALTER TABLE `navbar`
  ADD PRIMARY KEY IF NOT EXISTS (`id`),
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY IF NOT EXISTS (`id`),
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY IF NOT EXISTS (`username`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY IF NOT EXISTS (`cookie`);

--
-- Indexes for table `issues_list`
--
ALTER TABLE `issues_list`
  ADD PRIMARY KEY IF NOT EXISTS (`IssueId`, `ProjectId`),
  ADD KEY IF NOT EXISTS `issue_status_relationship` (`Status`),
  ADD KEY IF NOT EXISTS `issue_project_relationship` (`ProjectId`),
  ADD CONSTRAINT `issue_project_relationship` FOREIGN KEY IF NOT EXISTS (`ProjectId`) REFERENCES `issues_projects` (`ProjectId`),
  ADD CONSTRAINT `issue_status_relationship` FOREIGN KEY IF NOT EXISTS (`Status`) REFERENCES `status_options` (`status`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Indexes for table `projects`
--
ALTER TABLE `issues_projects`
  ADD PRIMARY KEY IF NOT EXISTS (`ProjectId`),
  MODIFY `ProjectId` int(11) NOT NULL AUTO_INCREMENT,
  ADD CONSTRAINT `issue_owner_relationship` FOREIGN KEY IF NOT EXISTS (`OwnerId`) REFERENCES `users` (`username`);

--
-- Indexes for table `status_options`
--
ALTER TABLE `status_options`
  ADD PRIMARY KEY IF NOT EXISTS (`status`);

CREATE TABLE IF NOT EXISTS `site_config` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `settingName` VARCHAR(128) NOT NULL , 
  `valueString` VARCHAR(512) NULL , 
  `editableBy` VARCHAR(128) NULL , 
  PRIMARY KEY (`id`)
  ) ENGINE = InnoDB;

-- GET active issues by Username and ProjectId, to make sure the user is incapable of viewing someone elses list.
CREATE PROCEDURE IF NOT EXISTS getIssuesByUsernameProjectId(_Username VARCHAR(32), _ProjectId int(11))
  SELECT * FROM issues_list LEFT JOIN issues_projects ON issues_list.ProjectId = issues_projects.ProjectId WHERE issues_list.ProjectId = _ProjectId AND OwnerId = _Username AND IsActive = 1;

-- GET active issues by Username the complete list of issues fo the user.
CREATE PROCEDURE IF NOT EXISTS getIssuesByUsername(_Username VARCHAR(32))
  SELECT * FROM issues_list LEFT JOIN issues_projects  ON issues_list.ProjectId = issues_projects.ProjectId WHERE OwnerId = _Username AND IsActive = 1;

--IF NOT EXISTS (SELECT * FROM sys.columns WHERE object_id = OBJECT_ID(N'users') AND name = 'SelectedProject')
ALTER TABLE `users` 
  ADD COLUMN IF NOT EXISTS `SelectedProject` INT NULL COMMENT 'The issue tracking project the user has actively selected' AFTER `account_approved`,
  ADD CONSTRAINT `users_selected_project` FOREIGN KEY IF NOT EXISTS (`SelectedProject`) REFERENCES `issues_projects` (`ProjectId`) ON DELETE SET NULL;