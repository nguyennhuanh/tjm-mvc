<?php
/*
	Tenkana Jquery Mobile MVC ( TJM-MVC ) 1.0 (c) 2011, Nguyen Nhu Anh

	http://www.tenkana.vn/
	
	File: PageModelBase.php
	Version: 1.0
	Description: 
	    - 

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

*/
interface PageModel{
    function pageLoad();
	function action();
}
abstract class PageModelBase implements PageModel{
    public $content = array();
	public function action(){
		foreach($_POST as $key => $val){
			$func = $key;
			$className = get_class($this);
			if (method_exists($className, $func)){				
				$this->$func($_REQUEST);
			}
		}
	}
	
	public function redirect($dest){
		header('Location: '.$dest);
	}
}