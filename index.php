<?php

/**
 * Composer is a better choice
 */
spl_autoload_register(function ($class)  {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
    if(file_exists($file)) {
        require_once $file;
    }
});

/**
 * If URL has some params get the PATH_INFO
 * else set to backslash, which means Homepage
 */
if (isset($_SERVER['PATH_INFO'])) {
    $path_split = explode('/', ltrim($_SERVER['PATH_INFO']));
    //$methodName = $path_split[2];
    $resource = __DIR__ . '/Resources/' . $path_split[1] . '.php';
    if(file_exists($resource)) {
            include_once $resource;
        } else {
            include_once __DIR__ . '/Resources/404.php';
            die();
        }

} else {
    include_once __DIR__ . '/Resources/login.php';
}
