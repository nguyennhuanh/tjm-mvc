<?php
/*
	Tenkana Jquery Mobile MVC ( TJM-MVC ) 1.0 (c) 2011, Nguyen Nhu Anh

	http://www.tenkana.vn/
	
	File: Routes.php
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
class Routes{
    public static function add($more_routes){
        global $system_page_routing;
        if (empty($system_page_routing)){
            $system_page_routing = array();
        }
        if (!is_array($more_routes)){
            return $system_page_routing;
        } else { 
            $system_page_routing = array_merge($system_page_routing, $more_routes);
            return $system_page_routing;
        }
    }
    
    public static function set($new_routes){
        global $system_page_routing;
        $system_page_routing = $new_routes;
    }
    
    public static function get(){
        global $system_page_routing;
        return $system_page_routing;
    }
}