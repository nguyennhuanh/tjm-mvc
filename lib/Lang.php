<?php
/*
	Tenkana Jquery Mobile MVC ( TJM-MVC ) 1.0 (c) 2011, Nguyen Nhu Anh

	http://www.tenkana.vn/
	
	File: Lang.php
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
class Lang {
    public static function load($lang){
		global $lang_array;
		$lang_array = Lang::init($lang);
	}
	
	public static function get(){
		global $lang_array;
		
		$args = func_get_args();
		if (empty($args)){
			return '';
		}		
		$key = $args[0];
		$args=array_slice($args, 1);
		if (!empty($args) && (count($args) > 0)){
			$tmp = $lang_array[$key];
			
			$sub_words = array();
			$sub_symbols = array();
			foreach($args as $a => $val){
				$sub_words[$a] = $val;
				$sub_symbols[$a] = '^'.$a;
			}
			
			$tmp = str_replace($sub_symbols, $sub_words, $tmp);
			
			if (count($sub_words) == 1){
				$tmp = str_replace('^', $sub_words[0], $tmp);
			}
			return $tmp;
		} else {
			if (isset($lang_array[$key]) && !empty($lang_array[$key])){
				return $lang_array[$key];
			}
		}

		return $key;
	}
	
	
	protected static function init($lang){
		global $lang_array;
		if (file_exists(LANG_DIR.$lang.'/lang.php')){
			require_once LANG_DIR.$lang.'/lang.php';
			return $lang_array;
		}
		return array();
	}
}