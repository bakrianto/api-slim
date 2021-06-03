<?php
/**
 * @package Rest API (DBConnection)
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *   
 */

// Database Connection
class DBConnection {
    
   public static function getConnection() {
        $_dbHostname = DB_HOST;
        $_dbName = DB_NAME;
        $_dbUsername = DB_USER;
        $_dbPassword = DB_PASS;
    	try {
        	$_con = new PDO("mysql:host=$_dbHostname;dbname=$_dbName", $_dbUsername, $_dbPassword);    
        	$_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $_con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	    } catch(PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
        return $_con;
    }
    
}
?>