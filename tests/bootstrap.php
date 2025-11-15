<?php

use Symfony\Component\Dotenv\Dotenv;
use Doctrine\ORM\Tools\SchemaTool;
use App\Kernel;

require dirname(__DIR__).'/vendor/autoload.php';

if (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}

if ($_SERVER['APP_DEBUG']) {
    umask(0000);
}

// Automatisches Schema-Bootstrapping für Testumgebung
if (($_SERVER['APP_ENV'] ?? null) === 'test') {
    $kernel = new Kernel('test', (bool) ($_SERVER['APP_DEBUG'] ?? false));
    $kernel->boot();

    $container = $kernel->getContainer();
    /** @var \Doctrine\ORM\EntityManagerInterface $em */
    $em = $container->get('doctrine')->getManager();

    $metadata = $em->getMetadataFactory()->getAllMetadata();
    if (!empty($metadata)) {
        $tool = new SchemaTool($em);
        // Dropt und erstellt das Schema frisch für jeden Testlauf
        $tool->dropDatabase();
        $tool->createSchema($metadata);
    }
}
