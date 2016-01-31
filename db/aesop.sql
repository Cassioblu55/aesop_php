-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 31, 2016 at 05:20 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aesop`
--

-- --------------------------------------------------------

--
-- Table structure for table `dungeon`
--

DROP TABLE IF EXISTS `dungeon`;
CREATE TABLE IF NOT EXISTS `dungeon` (
  `id` int(11) NOT NULL,
  `purpose` text COLLATE utf8_unicode_ci,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `history` text COLLATE utf8_unicode_ci,
  `location` text COLLATE utf8_unicode_ci,
  `creator` text COLLATE utf8_unicode_ci,
  `map` text COLLATE utf8_unicode_ci NOT NULL,
  `traps` text COLLATE utf8_unicode_ci,
  `size` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `other_information` text COLLATE utf8_unicode_ci,
  `owner_id` int(11) NOT NULL,
  `public` int(11) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approved` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `dungeon`:
--   `owner_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `dungeon_traits`
--

DROP TABLE IF EXISTS `dungeon_traits`;
CREATE TABLE IF NOT EXISTS `dungeon_traits` (
  `id` int(11) NOT NULL,
  `type` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `trait` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `weight` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `owner_id` int(11) NOT NULL,
  `public` int(11) NOT NULL DEFAULT '0',
  `approved` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `dungeon_traits`:
--   `owner_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `forest_encounters`
--

DROP TABLE IF EXISTS `forest_encounters`;
CREATE TABLE IF NOT EXISTS `forest_encounters` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `roll` text COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `public` int(11) NOT NULL DEFAULT '0',
  `approved` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `forest_encounters`:
--   `owner_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `monster`
--

DROP TABLE IF EXISTS `monster`;
CREATE TABLE IF NOT EXISTS `monster` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hit_points` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  `armor` int(11) DEFAULT NULL,
  `stats` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skills` text COLLATE utf8_unicode_ci,
  `languages` text COLLATE utf8_unicode_ci,
  `senses` text COLLATE utf8_unicode_ci,
  `challenge` float DEFAULT NULL,
  `xp` int(11) DEFAULT NULL,
  `abilities` text COLLATE utf8_unicode_ci,
  `actions` text COLLATE utf8_unicode_ci,
  `found` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `owner_id` int(11) NOT NULL,
  `public` int(11) NOT NULL DEFAULT '0',
  `approved` int(11) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `monster`:
--   `owner_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `npc`
--

DROP TABLE IF EXISTS `npc`;
CREATE TABLE IF NOT EXISTS `npc` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `flaw` text COLLATE utf8_unicode_ci,
  `interaction` text COLLATE utf8_unicode_ci,
  `mannerism` text COLLATE utf8_unicode_ci,
  `bond` text COLLATE utf8_unicode_ci,
  `appearance` text COLLATE utf8_unicode_ci,
  `talent` text COLLATE utf8_unicode_ci,
  `ideal` text COLLATE utf8_unicode_ci,
  `ability` text COLLATE utf8_unicode_ci,
  `owner_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `other_information` text COLLATE utf8_unicode_ci,
  `public` int(11) NOT NULL DEFAULT '0',
  `approved` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `npc`:
--   `owner_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `npc_traits`
--

DROP TABLE IF EXISTS `npc_traits`;
CREATE TABLE IF NOT EXISTS `npc_traits` (
  `id` int(11) NOT NULL,
  `trait` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `owner_id` int(11) NOT NULL,
  `public` int(11) NOT NULL DEFAULT '0',
  `approved` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `npc_traits`:
--   `owner_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `riddles`
--

DROP TABLE IF EXISTS `riddles`;
CREATE TABLE IF NOT EXISTS `riddles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `riddle` text COLLATE utf8_unicode_ci NOT NULL,
  `solution` text COLLATE utf8_unicode_ci NOT NULL,
  `hint` text COLLATE utf8_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '1',
  `other_information` text COLLATE utf8_unicode_ci,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `owner_id` int(11) NOT NULL,
  `approved` int(11) NOT NULL DEFAULT '0',
  `public` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `riddles`:
--   `owner_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `settlement`
--

DROP TABLE IF EXISTS `settlement`;
CREATE TABLE IF NOT EXISTS `settlement` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `known_for` text COLLATE utf8_unicode_ci,
  `notable_traits` text COLLATE utf8_unicode_ci,
  `ruler_status` text COLLATE utf8_unicode_ci,
  `current_calamity` text COLLATE utf8_unicode_ci,
  `ruler_id` int(11) NOT NULL,
  `population` int(11) NOT NULL,
  `size` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `race_relations` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_information` text COLLATE utf8_unicode_ci,
  `public` int(11) NOT NULL DEFAULT '0',
  `approved` int(11) NOT NULL DEFAULT '0',
  `owner_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `settlement`:
--   `owner_id`
--       `users` -> `id`
--   `ruler_id`
--       `npc` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `settlement_traits`
--

DROP TABLE IF EXISTS `settlement_traits`;
CREATE TABLE IF NOT EXISTS `settlement_traits` (
  `id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trait` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `owner_id` int(11) NOT NULL,
  `public` int(11) NOT NULL DEFAULT '0',
  `approved` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `settlement_traits`:
--   `owner_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `spell`
--

DROP TABLE IF EXISTS `spell`;
CREATE TABLE IF NOT EXISTS `spell` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `casting_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `range` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `components` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `owner_id` int(11) NOT NULL,
  `public` int(11) NOT NULL DEFAULT '0',
  `approved` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `spell`:
--   `owner_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `tavern`
--

DROP TABLE IF EXISTS `tavern`;
CREATE TABLE IF NOT EXISTS `tavern` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `type` text COLLATE utf8_unicode_ci,
  `tavern_owner_id` int(11) NOT NULL,
  `other_information` text COLLATE utf8_unicode_ci,
  `owner_id` int(11) NOT NULL,
  `public` int(11) NOT NULL DEFAULT '0',
  `approved` int(11) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `tavern`:
--   `owner_id`
--       `users` -> `id`
--   `tavern_owner_id`
--       `npc` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `tavern_traits`
--

DROP TABLE IF EXISTS `tavern_traits`;
CREATE TABLE IF NOT EXISTS `tavern_traits` (
  `id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trait` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `owner_id` int(11) NOT NULL,
  `public` int(11) NOT NULL DEFAULT '0',
  `approved` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `tavern_traits`:
--   `owner_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `traps`
--

DROP TABLE IF EXISTS `traps`;
CREATE TABLE IF NOT EXISTS `traps` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rolls` text COLLATE utf8_unicode_ci,
  `weight` int(11) DEFAULT '1',
  `approved` int(11) NOT NULL DEFAULT '0',
  `owner_id` int(11) NOT NULL,
  `public` int(11) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `traps`:
--   `owner_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `urban_encounters`
--

DROP TABLE IF EXISTS `urban_encounters`;
CREATE TABLE IF NOT EXISTS `urban_encounters` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `roll` text COLLATE utf8_unicode_ci NOT NULL,
  `approved` int(11) NOT NULL DEFAULT '0',
  `owner_id` int(11) NOT NULL,
  `public` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `urban_encounters`:
--   `owner_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `salt` char(16) COLLATE utf8_unicode_ci NOT NULL,
  `admin` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `protected` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `assestDefaultAccess` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `users`:
--

-- --------------------------------------------------------

--
-- Table structure for table `villain`
--

DROP TABLE IF EXISTS `villain`;
CREATE TABLE IF NOT EXISTS `villain` (
  `id` int(11) NOT NULL,
  `npc_id` int(11) NOT NULL,
  `method_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `method_description` text COLLATE utf8_unicode_ci,
  `scheme_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scheme_description` text COLLATE utf8_unicode_ci,
  `weakness_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weakness_description` text COLLATE utf8_unicode_ci,
  `other_information` text COLLATE utf8_unicode_ci,
  `owner_id` int(11) NOT NULL,
  `public` int(11) NOT NULL DEFAULT '0',
  `approved` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `villain`:
--   `npc_id`
--       `npc` -> `id`
--   `owner_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `villain_trait`
--

DROP TABLE IF EXISTS `villain_trait`;
CREATE TABLE IF NOT EXISTS `villain_trait` (
  `id` int(11) NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `kind` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `owner_id` int(11) NOT NULL,
  `public` int(11) NOT NULL DEFAULT '0',
  `approved` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `villain_trait`:
--   `owner_id`
--       `users` -> `id`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dungeon`
--
ALTER TABLE `dungeon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dungeon_traits`
--
ALTER TABLE `dungeon_traits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forest_encounters`
--
ALTER TABLE `forest_encounters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monster`
--
ALTER TABLE `monster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `npc`
--
ALTER TABLE `npc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `npc_traits`
--
ALTER TABLE `npc_traits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riddles`
--
ALTER TABLE `riddles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settlement`
--
ALTER TABLE `settlement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settlement_traits`
--
ALTER TABLE `settlement_traits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spell`
--
ALTER TABLE `spell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tavern`
--
ALTER TABLE `tavern`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tavern_traits`
--
ALTER TABLE `tavern_traits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `traps`
--
ALTER TABLE `traps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urban_encounters`
--
ALTER TABLE `urban_encounters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `villain`
--
ALTER TABLE `villain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `villain_trait`
--
ALTER TABLE `villain_trait`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dungeon`
--
ALTER TABLE `dungeon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dungeon_traits`
--
ALTER TABLE `dungeon_traits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forest_encounters`
--
ALTER TABLE `forest_encounters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `monster`
--
ALTER TABLE `monster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `npc`
--
ALTER TABLE `npc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `npc_traits`
--
ALTER TABLE `npc_traits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `riddles`
--
ALTER TABLE `riddles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settlement`
--
ALTER TABLE `settlement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settlement_traits`
--
ALTER TABLE `settlement_traits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `spell`
--
ALTER TABLE `spell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tavern`
--
ALTER TABLE `tavern`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tavern_traits`
--
ALTER TABLE `tavern_traits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `traps`
--
ALTER TABLE `traps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `urban_encounters`
--
ALTER TABLE `urban_encounters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `villain`
--
ALTER TABLE `villain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `villain_trait`
--
ALTER TABLE `villain_trait`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
