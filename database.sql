-- phpMyAdmin SQL Dump
-- version 2.11.8.1deb5+lenny8
-- http://www.phpmyadmin.net
--
-- Serveur: ted.reakserv.net
-- Généré le : Mer 27 Avril 2011 à 11:33
-- Version du serveur: 5.0.51
-- Version de PHP: 5.2.6-1+lenny10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `db_wikeo4`
--

-- --------------------------------------------------------

--
-- Structure de la table `todo_annotations`
--

CREATE TABLE `todo_annotations` (
  `id` int(9) unsigned NOT NULL auto_increment,
  `todo_id` int(9) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL,
  `author` varchar(32) NOT NULL,
  `contents` text NOT NULL,
  `created` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`,`todo_id`),
  KEY `date` (`date`),
  KEY `fk_todo_annotations_todo_todos1` (`todo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `todo_projects`
--

CREATE TABLE `todo_projects` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `begindate` int(11) unsigned NOT NULL default '0',
  `duedate` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `todo_sections`
--

CREATE TABLE `todo_sections` (
  `id` mediumint(7) unsigned NOT NULL auto_increment,
  `project_id` smallint(5) unsigned NOT NULL,
  `parent_id` varchar(45) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY  (`id`,`project_id`),
  KEY `fk_todo_sections_todo_projects1` (`project_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `todo_todos`
--

CREATE TABLE `todo_todos` (
  `id` int(9) unsigned NOT NULL auto_increment,
  `section_id` mediumint(7) unsigned NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `progress` tinyint(3) unsigned NOT NULL default '0',
  `duedate` int(10) unsigned NOT NULL default '0',
  `priority` tinyint(1) unsigned NOT NULL default '1',
  `status` enum('fixed','todo','tofix','wontfix') NOT NULL,
  PRIMARY KEY  (`id`,`section_id`),
  KEY `status` (`status`),
  KEY `fk_todo_todos_todo_sections1` (`section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `todo_users`
--

CREATE TABLE `todo_users` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `password` varchar(40) NOT NULL,
  `type` enum('administrator','user') NOT NULL,
  `connected` int(10) unsigned NOT NULL,
  `session` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `active` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Users using HuntSMS solutions';

-- --------------------------------------------------------

--
-- Structure de la table `todo_users_logs`
--

CREATE TABLE `todo_users_logs` (
  `login_id` mediumint(8) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL,
  `ip` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `todo_annotations`
--
ALTER TABLE `todo_annotations`
  ADD CONSTRAINT `todo_annotations_ibfk_1` FOREIGN KEY (`todo_id`) REFERENCES `todo_todos` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `todo_sections`
--
ALTER TABLE `todo_sections`
  ADD CONSTRAINT `fk_todo_sections_todo_projects1` FOREIGN KEY (`project_id`) REFERENCES `todo_projects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `todo_todos`
--
ALTER TABLE `todo_todos`
  ADD CONSTRAINT `fk_todo_todos_todo_sections1` FOREIGN KEY (`section_id`) REFERENCES `todo_sections` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

INSERT INTO `todo_users` (`id`, `password`, `type`, `connected`, `session`, `email`, `created`, `active`) VALUES
(1, 'd033e22ae348aeb5660fc2140aec35850c4da997', 'administrator', 1281986866, '', 'admin@cloudytodo.com', 0, 1);