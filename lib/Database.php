<?php
/*
	Tenkana Jquery Mobile MVC ( TJM-MVC ) 1.0 (c) 2011, Nguyen Nhu Anh

	http://www.tenkana.vn/
	
	File: Database.php
	Version: 1.0
	Description: 
	    - Set-up and store database connection

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

*/
/**
 * In this file you set up your database connection details.
 */
class Database{    
    public static function init($external_connection = null){
        global $system_database_connection_config;
        global $system_database_connection;
        if (!empty($external_connection)){
            $system_database_connection = $external_connection;
        } else {
            
            $db_host = Configure::read('db_host');
            $db_user = Configure::read('db_user');
            $db_pass = Configure::read('db_pass');
            $db_name = Configure::read('db_name');
            
            $system_database_connection_config = array(
                'driver' => empty($db_driver)?'mysql':$db_driver,
                'host' => empty($db_host)?'localhost':$db_host,
                'user' => $db_user,
                'password' => $db_pass,
                'database' => $db_name,
            );
        }
    }
    
    public static function getConnection(){
        global $system_database_connection;
        global $system_database_connection_config;
        
        if (empty($system_database_connection) || !isset($system_database_connection)){
            
            if (isset($system_database_connection_config) && !empty($system_database_connection_config)){
                $connection = mysql_connect($system_database_connection_config['host'], 
                                        $system_database_connection_config['user'], 
                                        $system_database_connection_config['password']);
                if (!$connection) {
                    die('Could not connect to database: ' . mysql_error());
                    return null;
                } else {
                    mysql_select_db($system_database_connection_config['database'], $connection);
                    $system_database_connection = $connection;
                }
            }            
        }
        
        return $system_database_connection;
    }
}