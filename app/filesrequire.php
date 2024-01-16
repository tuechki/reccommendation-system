<?php

require_once 'config/config.php';

require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';

// Autorequire Core Libraries
spl_autoload_register(function($className){
    // Library filename must match classname for this to work
    require_once 'libraries/' . $className .'.php';
});

?>