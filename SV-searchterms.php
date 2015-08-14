<?php
/*
Plugin Name: SV Searchterms
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: The plugin help you to auto add search term to your blog
Version: 1.0
Author: nguyenvanduocit
Author URI: http://nvduoc.senviet.org
License: LGPL-2.1, GPL-3.0+
*/
define('ST_FILE', __FILE__);
define('ST_DIR', __DIR__);
define('ST_VERSION', '1.0.0');
define('ST_DB_VERSION', '1.0.0');

require_once ST_DIR.'/vendor/autoload.php';

global $searchTerm;
$searchTerm = new \SearchTerm\SearchTerm();
$searchTerm->run();