<?php
/*
	Tenkana Jquery Mobile MVC ( TJM-MVC ) 1.0 (c) 2011, Nguyen Nhu Anh

	http://www.tenkana.vn/
	
	File: Application.php
	Version: 1.0
	Description: 
	    - This is the controller of the application which selects theme, 
		  processes request and forwards to requested page.

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

*/
class Application{    
    public function goPage($page){        
        /* テンプレートファイルを取得 */
        $theme = Configure::read('theme');
        
        $template_path = THEME_DIR.$theme.'/';        
        if (!file_exists($template_path.'Template.php')){
            $template_path = LIB_DIR;
        }
        
        $template_class = 'Template';
        if ($template_path == LIB_DIR){
            $template_class = 'TemplateBase';
        }        
        require_once $template_path.$template_class.'.php';    
        
        /* ページを取得し、遷移する */
        $page_routing = Routes::get();
        $template = new $template_class($page_routing[$page]['php']);
        
        if (isset($page_routing[$page]['js'])){
			if (is_array($page_routing[$page]['js'])){
				$template->script_src += $page_routing[$page]['js'];
			} else {
				$template->script_src[] = $page_routing[$page]['js'];
			}
        }
		
        if (isset($page_routing[$page]['css'])){
			if (is_array($page_routing[$page]['css'])){
				$template->style_src += $page_routing[$page]['css'];
			} else {
				$template->style_src[] = $page_routing[$page]['css'];
			}
        }
        
        $template->render();
    }
}