<?php

/* Loading composer packages */
if(file_exists(__DIR__.'/vendor/autoload.php')) {
	require_once __DIR__.'/vendor/autoload.php';
}

spl_autoload_register(function ($class_name) {
    require_once implode('/', explode('\\', __DIR__.'/'.$class_name .'.php'));
});