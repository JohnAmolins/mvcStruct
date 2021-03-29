<?php
require_once 'config/config.php';

# manual list libraries
//require_once 'libs/Controller.php';
//require_once 'libs/Core.php';
//require_once 'libs/Database.php';

# Autoloader for the libraries
spl_autoload_register(function($className){            // library file name needs to mach class name; passed a function that requires library files
    require_once 'libs/' . $className . '.php';
});