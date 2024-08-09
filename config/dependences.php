<?php 

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions([
    PDO::class => function ():PDO {
        return new PDO('mysql:host=localhost;dbname=aluraplay', 'root', 'Root123@');
    },
]);

/** @var \Psr\Container\ContainerInterface $container */
$container = $builder->build();

return $container;