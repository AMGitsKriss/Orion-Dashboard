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


-- Old table that was replaced by menu
DROP TABLE IF EXISTS navbar;
--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `name` varchar(32) NOT NULL,
  `id` int(4) NOT NULL,
  `url` text NOT NULL,
  `target` varchar(32) NOT NULL DEFAULT '_self' COMMENT 'Just in case a link wants to open in a new window',
  `icon` varchar(64) NOT NULL,
  `location` varchar(64) NOT NULL COMMENT 'The location of this link, such as mainmenu, or options',
  `order` decimal(6,3) NOT NULL COMMENT 'Desired order of elements.'
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
-- Indexes for table `menus`
--
ALTER TABLE `menus`
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

CREATE TABLE IF NOT EXISTS `site_config` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `settingName` VARCHAR(128) NOT NULL , 
  `valueString` VARCHAR(512) NULL , 
  `editableBy` VARCHAR(128) NULL , 
  PRIMARY KEY (`id`)
  ) ENGINE = InnoDB;

-- Get menu by location
CREATE PROCEDURE IF NOT EXISTS getMenu(_Location VARCHAR(64))
  SELECT * FROM menus WHERE location = _Location ORDER BY 'order' ASC;

-- Minecraft known-players table
CREATE TABLE IF NOT EXISTS `mc_players` ( 
  `mc_username` INT NOT NULL AUTO_INCREMENT , 
  `last_active` timestamp NULL , 
  `mc_avatar` varchar(255) NULL,
  PRIMARY KEY (`mc_username`)
  ) ENGINE = InnoDB;

-- drop the old mc_avatar col from users
ALTER TABLE `users` DROP COLUMN IF EXISTS `mc_avatar`;

-- Minecraft Logs
CREATE TABLE IF NOT EXISTS `mc_logs` ( 
  `id` INT NOT NULL AUTO_INCREMENT,
  `raw` VARCHAR(255) NOT NULL,
  `world` VARCHAR(128) NOT NULL,
  `filename` VARCHAR(128) NOT NULL, 
  `date` date NOT NULL, 
  `time` time NOT NULL, 

  `task` VARCHAR(128) NOT NULL, 
  `user` VARCHAR(128) NULL, -- Refer to the players table
  `message` text NOT NULL, 

  `ip` VARCHAR(15) NULL, 
  `uuid` VARCHAR(36) NULL, 
  `skipped_ticks` VARCHAR(32) NULL, 
  `millis_behind` VARCHAR(32) NULL, 
  `login_logout` bit NOT NULL DEFAULT 0, 
  `x` int NULL, 
  `y` int NULL, 
  `z` int NULL, 
  `last_parsed` TIMESTAMP NULL COMMENT 'Needs manually setting when an entry is successfully parsed.',
  PRIMARY KEY (`raw`, `date`),
  KEY (`id`)
  ) ENGINE = InnoDB;