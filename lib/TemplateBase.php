<?php
/*
	Tenkana Jquery Mobile MVC ( TJM-MVC ) 1.0 (c) 2011, Nguyen Nhu Anh

	http://www.tenkana.vn/
	
	File: TemplateBase.php
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
class TemplateBase{
    public $script_src;    
    public $style_src;
    
    public $file;
    public $title = 'Jquery mobile MVC!';
    public $pageId;
    
    public function __construct($file){
        $this->file = $file;
        $this->title = Configure::read('site_title');
        
        $this->script_src = array('jquery' => Configure::read('jquery'),
                                    'jquery-mobile' => Configure::read('jquery_mobile', 'js'),
                            );

        $this->style_src = array('jquery-mobile' => Configure::read('jquery_mobile', 'css'),); 
        
        $theme = Configure::read('theme');
        if (!empty($theme) && file_exists('themes/'.$theme.'/styles.css')){
            $this->style_src['custom-theme'] = 'themes/'.$theme.'/styles.css';
        }
                
        if (is_array($this->file)){
            foreach($file as $f){
                $this->pageId[$f] = strpos($f,"/")>0?
                        str_replace(".php", "", substr($f, strpos($f,"/") + 1)):
                        str_replace(".php", "", $f);
            }            
        } else {
            $this->pageId = strpos($file,"/")>0?
                        str_replace(".php", "", substr($file, strpos($file,"/") + 1)):
                        str_replace(".php", "", $file);
        }
    }
    
    public function doctype(){
        echo '<!DOCTYPE html>';
    }
    
    public function title(){
        echo '<title>'.$this->title.'</title>';
    }
    
    public function seo(){
        // add meta keyword if have any
        $app_keywords = Configure::read('app_keywords');        
        if (!empty($app_keywords)){
            echo '<meta name="keywords" content="'.$app_keywords.'">';
        }
        
        // add application description
        $app_description = Configure::read('app_description');                
        if (!empty($app_description)){
            echo '<meta name="description" content="'.$app_description.'">';
        }
        
        // add canonical
        $canonical = Configure::read('baseurl');                
        if (!empty($canonical)){
            echo '<link rel="canonical" href="'.$canonical.'" />';
        }
    }
    
    public function scripts(){
		foreach($this->script_src as $key => $val){
            if (!empty($val)){
                echo '<script language="javascript" type="text/javascript" src="'.$val.'"></script>';
            }
        }
	}
	
	public function styles(){
		foreach($this->style_src as $key => $val){
            if (!empty($val)){
                echo '<link rel="stylesheet" href="'.$val.'" />';
            }
        }
	}
    
    public function head(){
        echo '<HEAD>';
        $this->title();
        
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
        
        $this->seo();
        
        $this->scripts();
        $this->styles();
        
        echo '</HEAD>';
    }
    
    public function body(){
        echo '<BODY>';
        
        if (is_array($this->file)){
            foreach($this->file as $f){
                /* render pages */
                echo '<div data-role="page" id="'.$this->pageId[$f].'">';
                $this->header($f);        
                $this->contentMulti($f);        
                $this->footer($f);
                echo '</div>';
            }
        } else {            
            /* render the page */
            echo '<div data-role="page" id="'.$this->pageId.'">';
            $this->header();        
            $this->contentSingle();        
            $this->footer();
            echo '</div>';
        }
        
        echo '</BODY>';
    }
    
    public function header($f = null){
        if (isset($f) && !empty($f)){
            echo '<div id="'.$this->pageId[$f].'Header" data-role="header" data-theme="b"><a href="home" data-iconpos="notext" data-direction="reverse" data-icon="home" title="Home"></a><h1>TJM-MVC PHP</h1></div>';
        } else {
            echo '<div id="'.$this->pageId.'Header" data-role="header" data-theme="b"><a href="home" data-iconpos="notext" data-direction="reverse" data-icon="home" title="Home"></a><h1>TJM-MVC PHP</h1></div>';
        }
    }
    
    public function footer($f = null){
        if (isset($f) && !empty($f)){
            echo '<div id="'.$this->pageId[$f].'Footer" data-role="footer" data-theme="c" role="contentinfo"><p>© 2011 TJM-MVC Framework</p></div>';            
        } else {
            echo '<div id="'.$this->pageId.'Footer" data-role="footer" data-theme="c" role="contentinfo"><p>© 2011 TJM-MVC Framework</p></div>';
        }
    }
    
    public function contentSingle(){
        if (file_exists(MODEL_DIR.$this->pageId.'Model.php')){
            require_once MODEL_DIR.$this->pageId.'Model.php';
            $className = $this->pageId.'Model';            
            $pageModel = new $className;
			
			// do page action
			$pageModel->action();
			
			// call pageLoad before page loading
            $pageModel->pageLoad();
            
            if (is_array($pageModel->content)){
                extract($pageModel->content);
            }
        }
        
        if (Configure::read('template', 'content_div')){
            echo '<div id="'.$this->pageId.'Content" data-role="content">';
        } else {
            echo '<div id="'.$this->pageId.'Content">';
        }
        if (file_exists($this->file)){
            require_once $this->file;
        } else {
            $this->error();
        }
        echo '</div>';
    }
    
    public function contentMulti($file){
        if (file_exists(MODEL_DIR.$this->pageId[$file].'Model.php')){
            require_once MODEL_DIR.$this->pageId[$file].'Model.php';
            $className = $this->pageId[$file].'Model';
            $pageModel = new $className;
            
			// do page action
			$pageModel->action();
			
			// call pageLoad before page loading
			$pageModel->pageLoad();
			
            if (is_array($pageModel->content)){
                extract($pageModel->content);
            }
        }
        
        if (Configure::read('template', 'content_div')){
            echo '<div id="'.$this->pageId[$file].'Content" data-role="content">';
        } else {
            echo '<div id="'.$this->pageId[$file].'Content">';
        }
        if (file_exists($file)){
            require_once $file;
        } else {
            $this->error();
        }
        echo '</div>';
    }
    
    public function error(){
        echo '<p>Error：　Couldn\'t open the page.</p>';
    }
    
    public function render(){
        $cache = new Cache(Configure::read('cache'));
        
        $this->doctype();
        echo '<HTML>';
        $cache->start();
        $this->head(); /* head -- meta */
        $this->body(); /* header -- body -- footer */
        $cache->end();
        echo '</HTML>';        
    }
}