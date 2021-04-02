<?php
include "connect.php";
$installiptable="CREATE TABLE `CMS_IP` (
  `ID` bigint(20) NOT NULL auto_increment,
  `IP` varchar(60) NOT NULL default '',
  `EntryID` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
)";
mysql_query($installiptable) or die("Could not install tables");
$installarticles="CREATE TABLE `CMS_articles` (
  `EntryID` bigint(21) NOT NULL auto_increment,
  `title` varchar(60) NOT NULL default '',
  `body` longtext NOT NULL,
  `shortdescription` mediumtext NOT NULL,
  `totalscore` decimal(20,0) NOT NULL default '0',
  `numvotes` bigint(20) NOT NULL default '0',
  `timesviewed` bigint(20) NOT NULL default '0',
  `CMS_tsubmit` varchar(255) NOT NULL default '',
  `CMS_telapsed` bigint(21) NOT NULL default '0',
  `CMS_author` varchar(255) NOT NULL default '',
  `avgvotes` float NOT NULL default '0',
  PRIMARY KEY  (`EntryID`)
)";
mysql_query($installarticles) or die("Could not install articles");
$installadmin="
CREATE TABLE `CMS_logintable` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `username` varchar(32) default NULL,
  `password` varchar(32) default NULL,
  PRIMARY KEY  (`id`)
)";
mysql_query($installadmin) or die("Could not install admin");
print "Everything is installed, please delete this file.";
?>
