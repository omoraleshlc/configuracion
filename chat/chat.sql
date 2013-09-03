-- phpMyAdmin SQL Dump
-- version 2.8.0.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jun 26, 2006 at 02:43 PM
-- Server version: 4.1.12
-- PHP Version: 5.0.4
-- 
-- Database: `chat`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `chat`
-- 

CREATE TABLE `chat` (
  `usrnm` varchar(255) NOT NULL default '',
  `text` text,
  `color` varchar(6) NOT NULL default '',
  `time` time NOT NULL default '00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
