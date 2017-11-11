SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `orion_dashboard`
--

-- --------------------------------------------------------

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

-- --------------------------------------------------------

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

-- --------------------------------------------------------

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
  `IssueId` varchar(32) NOT NULL COMMENT 'Primary Key. ',
  `Name` varchar(255) NOT NULL COMMENT 'A name for the task.',
  `URL` varchar(2083) NOT NULL COMMENT 'IE URL limit.',
  `IsActive` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Is it worth caring about?',
  `Status` varchar(32) NOT NULL COMMENT 'Foreign key to a status table.',
  `Notes` text NOT NULL,
  `ProjectId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
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
-- Indexes for dumped tables
--

--
-- Indexes for table `linkaggregator`
--
ALTER TABLE `linkaggregator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `map_shortcuts`
--
ALTER TABLE `map_shortcuts`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `navbar`
--
ALTER TABLE `navbar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`cookie`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `linkaggregator`
--
ALTER TABLE `linkaggregator`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `navbar`
--
ALTER TABLE `navbar`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


--
-- Indexes for table `issues_list`
--
ALTER TABLE `issues_list`
  ADD PRIMARY KEY (`IssueId`),
  ADD KEY `issue_status_relationship` (`Status`),
  ADD KEY `issue_project_relationship` (`ProjectId`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ProjectId`);

--
-- Indexes for table `status_options`
--
ALTER TABLE `status_options`
  ADD PRIMARY KEY (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `ProjectId` int(11) NOT NULL AUTO_INCREMENT;
  ADD CONSTRAINT `issue_owner_relationship` FOREIGN KEY (`OwnerId`) REFERENCES `users` (`username`),
--
-- Constraints for dumped tables
--

--
-- Constraints for table `issues_list`
--
ALTER TABLE `issues_list`
  ADD CONSTRAINT `issue_project_relationship` FOREIGN KEY (`ProjectId`) REFERENCES `projects` (`ProjectId`),
  ADD CONSTRAINT `issue_status_relationship` FOREIGN KEY (`Status`) REFERENCES `status_options` (`status`) ON DELETE CASCADE ON UPDATE CASCADE;
