<?php
/*
	Tenkana Jquery Mobile MVC ( TJM-MVC ) 1.0 (c) 2011, Nguyen Nhu Anh

	http://www.tenkana.vn/
	
	File: Cache.php
	Version: 1.0
	Description: 
		- This class provide a quick caching for small project. 
	    - For more information on this cache class, 
		  check out this post: http://devgrow.com/simple-cache-class/

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

*/
class Cache {

    // Pages you do not want to Cache:
    var $doNotCache = array();

    // General Config Vars
    var $cacheDir = "./cache";
    var $cacheTime = 21600;
    var $caching = false;
    var $cacheFile;
    var $cacheFileName;
    var $cacheEnable = true;
    
    function __construct($params = null){
        if (isset($params) && !empty($params)){
            $this->cacheEnable = isset($params['cache_enable'])?$params['cache_enable']:true;
            $this->doNotCache = isset($params['do_not_cache'])?$params['do_not_cache']:array();
            $this->cacheTime = isset($params['cache_time'])?$params['cache_time']:21600;
        }        
        
        if(!is_dir($this->cacheDir)) mkdir($this->cacheDir, 0755);
        $this->cacheFile = md5($_SERVER['REQUEST_URI']);
        $this->cacheFileName = $this->cacheDir.'/'.$this->cacheFile.'.cache';        
    }
    
    function start(){
        $location = array_slice(explode('/',$_SERVER['REQUEST_URI']), 2);
        if(!in_array($location[0], $this->doNotCache) && $this->cacheEnable){
            
            if(file_exists($this->cacheFileName) && (time() - filemtime($this->cacheFileName)) 
                                    < $this->cacheTime){
                $this->caching = false;
                echo file_get_contents($this->cacheFileName);
                exit();
            }else{
                $this->caching = true;
                ob_start();
            }
        }
        if (!$this->cacheEnable){
            $this->purge_all();
        }
    }
    
    function end(){
        if($this->caching){
            file_put_contents($this->cacheFileName,ob_get_contents());
            ob_end_flush();
        }
    }
    
    function purge($location){
        if(file_exists($this->cacheFile) && is_writable($this->cacheDir)) unlink($this->cacheFile);
    }
    
    function purge_all(){
        if(!$dirhandle = @opendir($this->cacheDir)) return;
        while(false != ($filename = readdir($dirhandle))){
            if(substr($filename,-4) == '.cache') {
                $filename = $this->cacheDir. "/". $filename;
                unlink($filename);
            }
        }
    }

}