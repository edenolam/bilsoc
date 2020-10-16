<?php

use Symfony\Component\HttpFoundation\Request;

/** @var \Composer\Autoload\ClassLoader $loader */
require_once __DIR__.'/../app/autoload.php';

$loader = require __DIR__.'/../var/bootstrap.php.cache';
//$loader = new \Symfony\Component\ClassLoader\ApcClassLoader('cig-bs.fr', $loader);
//$loader->register(true);

$kernel = new AppKernel('prod', false);

//$kernel->loadClassCache();
//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();

// @see https://symfony.com/blog/fixing-the-trusted-proxies-configuration-for-symfony-3-3
// https://symfony.com/doc/3.4/deployment/proxies.html
Request::setTrustedProxies(['192.168.0.0/24'], Request::HEADER_X_FORWARDED_ALL);

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
