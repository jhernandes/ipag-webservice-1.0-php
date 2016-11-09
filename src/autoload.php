<?php
spl_autoload_register(function($className) {

    $namespace=str_replace("\\","/",__NAMESPACE__);
    $className=str_replace("\\","/",$className);
    $class= __DIR__ . "/{$className}.php";
    if (file_exists($class)) {
        require_once($class);
    }
});
