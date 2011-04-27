<?php defined('SYSPATH') or die('No direct script access.');

/* 
 * If true, the debug toolbar will be automagically displayed
 * NOTE: if IN_PRODUCTION is set to TRUE, the toolbar will
 * not automatically render, even if auto_render is TRUE
 */
$config['auto_render'] = TRUE;

/* 
 * If true, the toolbar will default to the minimized position
 */
$config['minimized'] = FALSE;

/* 
 * Location of icon images
 * relative to your site_domain
 */
$config['icon_path'] = 'ressources/images/debug-toolbar';

/*
 * Log toolbar data to FirePHP
 */
$config['firephp_enabled'] = TRUE;

/* 
 * Enable or disable specific panels
 */
$config['panels'] = array(
	'benchmarks'		=> TRUE,
	'database'			=> (Kohana::$environment === 'development') ? true : false,
	'vars'				=> (Kohana::$environment === 'development') ? true : false,
	'ajax'				=> (Kohana::$environment === 'development') ? true : false,
	'files'				=> (Kohana::$environment === 'development') ? true : false,
	'modules'			=> (Kohana::$environment === 'development') ? true : false,
	'routes'			=> (Kohana::$environment === 'development') ? true : false,
);

/*
 * Toolbar alignment
 * options: right, left, center
 */
$config['align'] = 'right';

/*
 * Secret Key
 */ 
$config['secret_key'] = FALSE;

return $config;
