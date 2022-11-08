<?php

function loadClassApp($class_name) {
    if(file_exists(dirname(__FILE__).'/classe/'.$class_name.'.class.php')){
        require_once (dirname(__FILE__).'/classe/'.$class_name.'.class.php');
    }
}

spl_autoload_register('loadClassApp');

?>
