<?php
/*
	Tenkana Jquery Mobile MVC ( TJM-MVC ) 1.0 (c) 2011, Nguyen Nhu Anh

	http://www.tenkana.vn/
	
	File: bootstrap.php
	Version: 1.0
	Description: 
	    - This file is loaded automatically by the index.php
		- Use this to set up database details and other stuff

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

*/
 
if (!defined('VERSION')) { // don't allow this page to be requested directly from browser
    header('Location: ./index.php');
    exit;
}

/*
* Load core classes
*/
require_once LIB_DIR.'Cache.php';
require_once LIB_DIR.'Configure.php';
require_once LIB_DIR.'Database.php';
require_once LIB_DIR.'Routes.php';
require_once LIB_DIR.'PageModelBase.php';
require_once LIB_DIR.'TemplateBase.php';
require_once LIB_DIR.'Application.php';
require_once LIB_DIR.'BasicAuth.php';
require_once LIB_DIR.'Lang.php';

/*
	======================================================================
	  THE DEFINITIONS BELOW ARE REQUIRED AND MUST BE SET BEFORE USING!
	======================================================================
*/

/*
* Define jquery & jquery lib link. If dont use, just leave it as blank
*/
Configure::write('http://code.jquery.com/jquery-1.6.2.min.js', 'jquery');

Configure::write('http://code.jquery.com/mobile/1.0b3/jquery.mobile-1.0b3.min.js', 'jquery_mobile', 'js');
Configure::write('http://code.jquery.com/mobile/1.0b3/jquery.mobile-1.0b3.min.css', 'jquery_mobile', 'css');

/*
* Database setting
*/
Configure::write('localhost', 'db_host');
Configure::write('root', 'db_user');
Configure::write('your_pass', 'db_pass');
Configure::write('your_db', 'db_name');
/*
* In case you want to use connection from another program, you can init Database object with parameter $external_connection
* Database::init($external_connection)
*/
//Database::init();

Configure::write('default', 'theme'); // Load a new theme
Configure::write(false, 'template', 'content_div'); // true: using content_div on template
Configure::write('TJM-MVC', 'site_title');

/*
* Language setting
*/
Lang::load('en');

/*
* Routing table setting: path to pages, js, css.
*/
/*
// More example about Routes:
Routes::add(array('home' => array( 'php' => array('pages/HomePage.php', 'pages/AboutPage.php' ),                                                     
                                    'js' => array('graph' => 'js/dummy.js',),
                                    'css' => array('graph' => 'js/dummy.css',),),    
                    'login' => array( 'php' => 'pages/LoginPage.php',),                
                    'error' => array( 'php' => 'pages/ErrorPage.php',),
                ));
*/
Routes::add(array('home' => array( 'php' => array('pages/HomePage.php'),),    
                    'intro' => array( 'php' => 'pages/IntroPage.php',),
					'quickstart' => array( 'php' => 'pages/QuickstartPage.php',),
                    'feature' => array( 'php' => 'pages/FeaturePage.php',),
					'license' => array( 'php' => 'pages/LicensePage.php',),
					'download' => array( 'php' => 'pages/DownloadPage.php',),
					'showcase' => array( 'php' => 'pages/ShowcasePage.php',),
					'restrict' => array( 'php' => 'pages/RestrictPage.php',),
                    'login' => array( 'php' => 'pages/LoginPage.php',),
                    'error' => array( 'php' => 'pages/ErrorPage.php',),
                ));

/*
* Cache setting
*/
Configure::write(array( 'cache_enable' => false,
                        'do_not_cache' => array(),
                        'cache_time' => 21600,), 'cache');

/*
* SEO setting
*/
Configure::write('jquery mobile, jquery mobile mvc, jquery mobile php, jquery mobile framework', 'app_keywords'); // meta keywords
Configure::write('A very lightweight PHP MVC framework utilizing jQuery Mobile', 'app_description'); // meta app description
Configure::write('http://tjm.tenkana.vn', 'baseurl'); // meta app canonical url
            
/*
* Authentication setting
* Option 1: Set params with your table and field which are used for validating
*     - Example: BasicAuth::setSource('users', 'username', 'password');
* Option 2: Set params with your fixed account
*     - Example: BasicAuth::setSource('NO_SQL_AUTH', 'admin', 'admin');
*/
BasicAuth::setSource('NO_SQL_AUTH', 'admin', 'admin');