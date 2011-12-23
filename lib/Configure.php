<?php
/*
	Tenkana Jquery Mobile MVC ( TJM-MVC ) 1.0 (c) 2011, Nguyen Nhu Anh

	http://www.tenkana.vn/
	
	File: Configure.php
	Version: 1.0
	Description: 
	    - Store parameters and other stuff of the project 

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

*/
class Configure{
    public static function write($value, $section, $key = null){
        global $system_config;
        if (empty($system_config)){
            $system_config = array();
        }
        if ($section == null && $key == null){
            return;
        }
        if ($key == null){
            $system_config[$section] = $value;
        } else {
            $system_config[$section][$key] = $value;
        }
    }
    
    public static function read($section, $key = null){
        global $system_config;
        if (empty($system_config)){
            $system_config = array();
        }
        if ($section == null && $key == null){
            return null;
        }
        if ($key == null){
            if (isset($system_config[$section]))
                return $system_config[$section];
        }
        if (isset($system_config[$section][$key]))
            return $system_config[$section][$key];
        return null;
    }
}