<?php
require_once FRAMEWORKPATH . 'Yamveecee' . DIRECTORY_SEPARATOR . 'Classloader.php';

$configFinder = new \Yamveecee\Resources\Finder();
$configFinder->addPath(APPPATH . 'config');
// $configFinder->addParser('.array.php', new \Yamveecee\Resources\Parser\PhpArray());
$configFinder->addParser('.json', new \Yamveecee\Resources\Parser\Json());
// $configFinder->addParser('.xml', new \Yamveecee\Resources\Parser\Xml());
// $configFinder->addParser('.yml', new \Yamveecee\Resources\Parser\Yaml());

$configFactory = new \Yamveecee\Config\Factory();

$configLoader = new \Yamveecee\Config\Loader();
$configLoader->setResourcesFinder($configFinder);
$configLoader->setConfigFactory($configFactory);

$serviceLocator = \Yamveecee\ServiceLocator::getInstance($configLoader->getConfig('serviceLocator'));
$serviceLocator->addService('configLoader', $configLoader);

$response = $dispatcher->route($serviceLocator->getRequestFactory()->getRequest());
$response->render();