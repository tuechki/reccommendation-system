<?php
    // DB Params
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', "");
    define('DB_NAME', 'curriculumsprojectdb');
    /* 
        App Root - whatever the path of the project folder on the machine is + \app folder. 
        dirname(dirname(__FILE__)) - two folders back from the current (config) file, should also work
    */
    define('APPROOT',  dirname(dirname(__FILE__)));    
    // Url Root
    define('URLROOT', 'http://localhost/recommendation-system');
    // Site Name
    define('SITENAME', 'FMI course');

    define('APPVERSION', '1.0.0');
?>
