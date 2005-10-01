<?php
/**
* $Id: mysql.sql.php,v 1.11 2005-10-01 14:53:16 thorstenr Exp $
*
* CREATE TABLE instruction for MySQL database
*
* @author       Thorsten Rinne <thorsten@phpmyfaq.de>
* @author       Tom Rochester <tom.rochester@gmail.com>
* @since        2004-09-18
* @copyright    (c) 2001-2004 phpMyFAQ Team
* 
* The contents of this file are subject to the Mozilla Public License
* Version 1.1 (the "License"); you may not use this file except in
* compliance with the License. You may obtain a copy of the License at
* http://www.mozilla.org/MPL/
* 
* Software distributed under the License is distributed on an "AS IS"
* basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
* License for the specific language governing rights and limitations
* under the License.
*/

$uninst[] = "DROP TABLE ".$sqltblpre."faqadminlog";
$uninst[] = "DROP TABLE ".$sqltblpre."faqadminsessions";
$uninst[] = "DROP TABLE ".$sqltblpre."faqcategories";
$uninst[] = "DROP TABLE ".$sqltblpre."faqcategoryrelations";
$uninst[] = "DROP TABLE ".$sqltblpre."faqchanges";
$uninst[] = "DROP TABLE ".$sqltblpre."faqcomments";
$uninst[] = "DROP TABLE ".$sqltblpre."faqdata";
$uninst[] = "DROP TABLE ".$sqltblpre."faqfragen";
$uninst[] = "DROP TABLE ".$sqltblpre."faqnews";
$uninst[] = "DROP TABLE ".$sqltblpre."faqvoting";
$uninst[] = "DROP TABLE ".$sqltblpre."faqsessions";
$uninst[] = "DROP TABLE ".$sqltblpre."faquser";
$uninst[] = "DROP TABLE ".$sqltblpre."faqvisits";
$uninst[] = "DROP TABLE ".$sqltblpre."faqglossary";

//faquser
$query[] = "CREATE TABLE IF NOT EXISTS ".$sqltblpre."faquser (
id int(2) NOT NULL,
name text NOT NULL,
pass varchar(64) BINARY NOT NULL,
realname varchar(255) NOT NULL default '',
email varchar(255) NOT NULL default '',
rights varchar(255) NOT NULL,
PRIMARY KEY (id))";

//faqdata
$query[] = "CREATE TABLE IF NOT EXISTS ".$sqltblpre."faqdata (
id int(11) NOT NULL,
lang varchar(5) NOT NULL,
active char(3) NOT NULL,
keywords text NOT NULL,
thema text NOT NULL,
content longtext NOT NULL,
author varchar(255) NOT NULL,
email varchar(255) NOT NULL,
comment enum('y','n') NOT NULL default 'y',
datum varchar(15) NOT NULL,
linkState VARCHAR(7) NOT NULL,
linkCheckDate INT(11) DEFAULT '0' NOT NULL,
FULLTEXT (keywords,thema,content),
PRIMARY KEY (id, lang)) TYPE = MYISAM";

//faqadminlog
$query[] = "CREATE TABLE IF NOT EXISTS ".$sqltblpre."faqadminlog (
id int(11) NOT NULL,
time int(11) NOT NULL,
usr int(11) NOT NULL,
text text NOT NULL,
ip text NOT NULL,
PRIMARY KEY (id))";

//faqadminsessions
$query[] = "CREATE TABLE IF NOT EXISTS ".$sqltblpre."faqadminsessions (
uin varchar(50) BINARY NOT NULL,
usr tinytext NOT NULL,
pass varchar(64) BINARY NOT NULL,
ip text NOT NULL,
time int(11) NOT NULL)";

//faqcategories
$query[] = "CREATE TABLE IF NOT EXISTS ".$sqltblpre."faqcategories (
id INT(11) NOT NULL,
lang VARCHAR(5) NOT NULL,
parent_id INT(11) NOT NULL,
name VARCHAR(255) NOT NULL,
description VARCHAR(255) NOT NULL,
user_id int(2) NOT NULL,
PRIMARY KEY (id,lang))";

//faqcategoryrelations
$query[] = "CREATE TABLE ".$sqltblpre."faqcategoryrelations (
category_id INT(11) NOT NULL,
category_lang VARCHAR(5) NOT NULL default '',
record_id INT(11) NOT NULL,
record_lang VARCHAR(5) NOT NULL default '',
PRIMARY KEY  (category_id,category_lang,record_id,record_lang)
)";

//faqchanges
$query[] = "CREATE TABLE IF NOT EXISTS ".$sqltblpre."faqchanges (
id int(11) NOT NULL,
beitrag int(11) NOT NULL,
lang varchar(5) NOT NULL,
usr int(11) NOT NULL,
datum int(11) NOT NULL,
what text NOT NULL,
PRIMARY KEY (id))";

//faqcomments
$query[] = "CREATE TABLE IF NOT EXISTS ".$sqltblpre."faqcomments (
id_comment int(11) NOT NULL,
id int(11) NOT NULL,
usr varchar(255) NOT NULL,
email varchar(255) NOT NULL,
comment text NOT NULL,
datum int(15) NOT NULL,
helped text NOT NULL,
PRIMARY KEY (id_comment))";

//faqfragen
$query[] = "CREATE TABLE IF NOT EXISTS ".$sqltblpre."faqfragen (
id int(11) unsigned NOT NULL,
ask_username varchar(100) NOT NULL,
ask_usermail varchar(100) NOT NULL,
ask_rubrik varchar(100) NOT NULL,
ask_content text NOT NULL,
ask_date varchar(20) NOT NULL,
PRIMARY KEY (id))";

//faqnews
$query[] = "CREATE TABLE IF NOT EXISTS ".$sqltblpre."faqnews (
id int(11) NOT NULL,
header varchar(255) NOT NULL,
artikel text NOT NULL,
datum varchar(14) NOT NULL,
link varchar(255) NOT NULL,
linktitel varchar(255) NOT NULL,
target varchar(255) NOT NULL,
PRIMARY KEY (id))";

//faqvoting
$query[] = "CREATE TABLE IF NOT EXISTS ".$sqltblpre."faqvoting (
id int(11) unsigned NOT NULL,
artikel int(11) unsigned NOT NULL,
vote int(11) unsigned NOT NULL,
usr int(11) unsigned NOT NULL,
datum varchar(20) NOT NULL default '',
ip varchar(15) NOT NULL default '',
PRIMARY KEY (id))";

//faqsessions
$query[] = "CREATE TABLE IF NOT EXISTS ".$sqltblpre."faqsessions (
sid int(11) NOT NULL,
ip text NOT NULL,
time int(11) NOT NULL,
PRIMARY KEY sid (sid))";

//faqvisits
$query[] = "CREATE TABLE IF NOT EXISTS ".$sqltblpre."faqvisits (
id int(11) NOT NULL,
lang varchar(5) NOT NULL,
visits int(11) NOT NULL,
last_visit int(15) NOT NULL,
PRIMARY KEY (id, lang))";

// faqglossary
$query[] = "CREATE TABLE ".$sqltblpre."faqglossary (
id INT(11) NOT NULL ,
lang VARCHAR(2) NOT NULL ,
item VARCHAR(255) NOT NULL ,
definition TEXT NOT NULL,
PRIMARY KEY (id, lang))";

$query[] = "INSERT INTO ".$sqltblpre."faquser (id, name, pass, realname, email, rights) VALUES (1, 'admin', '".md5($password)."', '".$realname."', '".$email."', '1111111111111111111111111')";
