<?php
/*
Plugin Name: WP Quizz
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: The plugin help you to auto add search term to your blog
Version: 1.0
Author: nguyenvanduocit
Author URI: http://nvduoc.senviet.org
License: LGPL-2.1, GPL-3.0+
*/
define('WPQ_FILE', __FILE__);
define('WPQ_DIR', __DIR__);
define('WPQ_VERSION', '1.0.0');
define('WPQ_DB_VERSION', '1.0.0');

require_once WPQ_DIR.'/vendor/autoload.php';

global $searchTerm;
$searchTerm = new \WPQuizz\WPQuizz();
$searchTerm->run();