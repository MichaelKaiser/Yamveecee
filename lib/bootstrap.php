<?php
require_once FRAMEWORKPATH . 'Yamveecee' . DIRECTORY_SEPARATOR . 'Classloader.php';

$configFinder = new \Yamveecee\Resources\Finder();
$configFinder->addPath(APPPATH . 'config');

$configLoader = new \Yamveecee\Config\Loader();
$configLoader->setResourcesFinder($configFinder);
// $configLoader->addParser('.array.php', new \Yamveecee\Config\Parser\PhpArray());
$configLoader->addParser('.json', new \Yamveecee\Config\Parser\Json());
// $configLoader->addParser('.xml', new \Yamveecee\Config\Parser\Xml());
// $configLoader->addParser('.yml', new \Yamveecee\Config\Parser\Yaml());

$serviceLocator = \Yamveecee\Service\Locator::getInstance($configLoader->getConfig('serviceLocator'));
$serviceLocator->addConfigurationLoaderService($configLoader);

$dispatcher = $serviceLocator->getDispatcher();
$response = $dispatcher->route($serviceLocator->getRequestFactory()->getRequest());
$response->render();
