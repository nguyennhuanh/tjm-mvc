<?php
/*
	Tenkana Jquery Mobile MVC ( TJM-MVC ) 1.0 (c) 2011, Nguyen Nhu Anh

	http://www.tenkana.vn/
	
	File: Template.php
	Version: 1.0
	Description: 
	    - Using this class to override original TemplateBase class 
		  if you want to change program appearance

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

*/
class Template extends TemplateBase{
    // Custom error-page
    public function error(){
        echo '<h1>404 Error</h1>'.
            '<p>Sorry, we couldn\'t find that page. Please check the URL or try again later.</p>';
    }
	// Uncomment header and footer functions below to override appreance of your page.
	/*
	public function header($f = null){
        
    }
	
	public function footer($f = null){
        
    }
	*/
}