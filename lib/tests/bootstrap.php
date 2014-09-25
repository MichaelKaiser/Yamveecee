<?php
// Use PSR-0 autoloader
require_once('SplClassLoader.php');
$classLoader = new SplClassLoader('Yamveecee', dirname(__FILE__) . '/..');
$classLoader->register();
