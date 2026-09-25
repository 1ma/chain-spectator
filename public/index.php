<?php

declare(strict_types=1);

use ChainSpectator\Action\HomeAction;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;

require_once __DIR__ . '/../vendor/autoload.php';

$builder = new ContainerBuilder();
$builder
    ->useAttributes(false)
    ->useAutowiring(false);

$builder->addDefinitions([
    Twig::class => function (): Twig {
        return Twig::create(__ROOT__ . '/etc/twig', [
            'cache' => false,
        ]);
    },

    HomeAction::class => function (ContainerInterface $c): HomeAction {
        return new HomeAction($c->get(Twig::class));
    },
]);

$container = $builder->build();

$app = AppFactory::createFromContainer($container);

$app->get('/', HomeAction::class);

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

$app->run();
