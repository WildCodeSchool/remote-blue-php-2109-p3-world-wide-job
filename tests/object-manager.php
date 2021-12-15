<?php

// this file is in tests/object-manager.php

use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

(new Dotenv())->bootEnv(__DIR__ . '/../.env');

$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$kernel->boot();
/** @var \Doctrine\Bundle\DoctrineBundle\Registry */
$doctrine = $kernel->getContainer()->get('doctrine');
return $doctrine->getManager();
