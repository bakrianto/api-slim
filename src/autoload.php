<?php

// Load configurations
require "config/config.php";
// Load authentication
require "libs/auth.php";
// Load database connection
require "libs/DBConnection.php";
// Load mail
require "libs/mail.php";
// Load api
require "routes/api.php";
// load Employee class 
require "models/Employee.php";

?>
