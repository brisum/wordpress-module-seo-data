<?php

use Brisum\Lib\ObjectManager;

ObjectManager::getInstance()->create('Brisum\Wordpress\SeoData\Admin\Page\Edit');


/*

CREATE TABLE `kt4_brisum_seo_data` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `url` varchar(255) NOT NULL,
 `title` text NOT NULL,
 `meta_title` text NOT NULL,
 `meta_description` text NOT NULL,
 `meta_keywords` text NOT NULL,
 `h1` varchar(255) NOT NULL,
 `content` text NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8

*/