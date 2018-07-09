<?php

use Doctrine\Common\ClassLoader;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class Doctrine
{
    public $em = null;

    public function __construct($connectionOptions)
    {
        $entitiesClassLoader = new ClassLoader(
            "TestDev\Entity",
            __DIR__."/../src/SimpleCrud/Entity"
        );
        $entitiesClassLoader->register();

        $isDevMode = true;
        $config    = Setup::createAnnotationMetadataConfiguration(
            array(__DIR__."/../src/SimpleCrud/Entity"),
            $isDevMode
        );

        $this->em = EntityManager::create($connectionOptions, $config);
    }
}
