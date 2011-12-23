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
Header('Cache-Control: no-cache');
Header('Pragma: no-cache');

require_once 'define.inc';
require_once 'bootstrap.php';

$page = isset($_GET['p']) && !empty($_GET['p'])?$_GET['p']:'home';
$app = new Application();

$app->goPage($page);