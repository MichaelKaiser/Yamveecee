<?php
require_once FRAMEWORKPATH . 'Yamveecee' . DIRECTORY_SEPARATOR . 'Classloader.php';

$classLoader = new \Yamveecee\Classloader();
$classLoader->register();

$classFinder = new \Yamveecee\Resources\Finder();
$classFinder->addPath(dirname(__FILE__));
$classFinder->addPath(APPPATH . 'lib');
$classLoader->setResourceFinder($classFinder);

$configFinder = new \Yamveecee\Resources\Finder();
$configFinder->addPath(APPPATH . 'config');

$configLoader = new \Yamveecee\Config\Loader();
$configLoader->setResourcesFinder($configFinder);
// $configLoader->addParser('.array.php', new \Yamveecee\Config\Parser\PhpArray());
$configLoader->addParser('.json', new \Yamveecee\Config\Parser\Json());
// $configLoader->addParser('.xml', new \Yamveecee\Config\Parser\Xml());
// $configLoader->addParser('.yml', new \Yamveecee\Config\Parser\Yaml());
$configLoader->init();

$serviceLocator = \Yamveecee\Service\Locator::getInstance($configLoader->getConfig('serviceLocator'));
$serviceLocator->addConfigurationLoaderService($configLoader);

$classFinderService = new \Yamveecee\Service\ClassFinder();
$classFinderService->setResourceFinder($classFinder);
$serviceLocator->addService('classFinder', $classFinderService);

$dispatcher = $serviceLocator->getDispatcher();
$response = $dispatcher->route($serviceLocator->getRequestFactory()->getRequest());
$response->render();
