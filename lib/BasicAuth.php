<?php
/*
	Tenkana Jquery Mobile MVC ( TJM-MVC ) 1.0 (c) 2011, Nguyen Nhu Anh

	http://www.tenkana.vn/
	
	File: BasicAuth.php
	Version: 1.0
	Description: 
	    A simple authentication/login class. 
		You can also use MYSQL logon table or specify an access list in code.
		See example setting below:

		Option 1: Set params with your table and field which are used for validating
			 - Example: BasicAuth::setSource('users', 'username', 'password');
						Here, 'users' is logon table; 'username', 'password' are field name.
		Option 2: Set params with your fixed account
			 - Example: BasicAuth::setSource('NO_SQL_AUTH', 'admin', 'admin'); 

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

*/
class BasicAuth{
    private static $login_field;
    private static $password_field;
    private static $table;
    private static $secret_key = "GJDdev29KakezsB";
	private static $app_key = "WKapmThGZGCnKBZQ"; // login key
    
    public static function validate(){
        // verify if cookie exists, if exists...
        if (isset($_COOKIE[BasicAuth::$app_key]) && $_COOKIE[BasicAuth::$app_key]){
            list($c_username, $cookie_hash) = split(',', $_COOKIE[BasicAuth::$app_key]);
            if (md5($c_username.BasicAuth::$secret_key) == $cookie_hash) {                
                $login = $c_username;
            } 
        }

        if (isset($login) && !empty($login)) {    
            return $login;
        }
        
        return null;
    }
	
	public static function logout(){
		setcookie(BasicAuth::$app_key, "", strtotime("+30 days"), "/");
	}
    
    public static function verify($login, $password){
        if (BasicAuth::$table == 'NO_SQL_AUTH'){
            if (($login == BasicAuth::$login_field ) 
                && ($password == BasicAuth::$password_field )){
                $result = true;
            }
        } else {
            $mysqli = Database::getConnection();
            $sql = "SELECT * FROM ".BasicAuth::$table.
                " WHERE ".BasicAuth::$login_field."='".$login.
                "' AND ".BasicAuth::$password_field."='".$password."'";
            if (!empty($mysqli)){
                $result = mysql_query($sql, $mysqli);
                $result = !empty($result);
            }
        }
        
        // return true if logged in and false if not        
        if(!empty($result) && $result){            
            // If logged, update session
            setcookie(BasicAuth::$app_key, 
					$login.','.md5($login.BasicAuth::$secret_key), 
					strtotime("+30 days"), "/");
            return true;
        }

        return false;        
    }
    
    public static function setSource($table, $login_field, $password_field){
        BasicAuth::$table = $table;
        BasicAuth::$login_field = $login_field;
        BasicAuth::$password_field = $password_field;
    }
    
}