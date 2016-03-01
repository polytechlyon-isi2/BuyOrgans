create database if not exists buyorgans character set utf8 collate utf8_unicode_ci;

use buyorgans;


grant all privileges on buyorgans.* to 'buyorgans_user'@'localhost' identified by 'secret';