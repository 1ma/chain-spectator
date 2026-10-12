<?php

declare(strict_types=1);

use ChainSpectator\Action\AddressAction;
use ChainSpectator\Action\AddressTxsAction;
use ChainSpectator\Action\BlockAction;
use ChainSpectator\Action\HomeAction;
use ChainSpectator\Action\TransactionAction;
use ChainSpectator\Middleware\HxHeaderRedirect;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Views\Twig;

require_once __DIR__ . '/../vendor/autoload.php';

$builder = new ContainerBuilder()
    ->useAttributes(false)
    ->useAutowiring(true);

$builder->addDefinitions([
    Twig::class => function (): Twig {
        return Twig::create(__ROOT__ . '/etc/twig', [
            'cache' => false,
        ]);
    }
]);

$app = AppFactory::createFromContainer($builder->build());

$app->get('/', HomeAction::class);
$app->get('/block/{blockhash}', BlockAction::class);
$app->get('/tx/{txid}', TransactionAction::class);
$app->get('/address/{addr}', AddressAction::class);

$app->group('/_hx', function (RouteCollectorProxy $_hx) {
    $_hx->get('/address/{addr}/txs', AddressTxsAction::class);
})
    ->add(HxHeaderRedirect::class);

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

$app->run();
