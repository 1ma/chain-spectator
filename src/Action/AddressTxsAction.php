<?php

declare(strict_types=1);

namespace ChainSpectator\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

final readonly class AddressTxsAction implements RequestHandlerInterface
{
    public function __construct(
        private Twig $twig,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();
        $addr = $route->getArgument('addr');

        $transactions = [
            [
                'txid'      => 'c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9b0c1d2e3f4a5b6c7d8e9f0a1b2c3d4',
                'timestamp' => '2024-09-10 17:22',
                'fee'       => 1540,
                'fee_rate'  => 10.2,
                'inputs'    => [
                    ['address' => 'bc1qm7n8p9q0r1s2t3u4v5w6x7y8z9a0b1c2d3e4f5', 'value' => '0.30000000'],
                ],
                'outputs' => [
                    ['address' => 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh', 'value' => '0.25000000'],
                    ['address' => 'bc1qf6g7h8j9k0l1m2n3p4q5r6s7t8u9v0w1x2y3z4', 'value' => '0.04846000'],
                ],
            ],
            [
                'txid'      => 'e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9b0c1d2e3f4a5b6c7d8e9f0a1b2c3d4e5f6',
                'timestamp' => '2024-09-08 03:56',
                'fee'       => 2280,
                'fee_rate'  => 15.0,
                'inputs'    => [
                    ['address' => 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh', 'value' => '0.40000000'],
                ],
                'outputs' => [
                    ['address' => 'bc1qh8j9k0l1m2n3p4q5r6s7t8u9v0w1x2y3z4a5b6', 'value' => '0.39772000'],
                ],
            ],
        ];

        return $this->twig->render(new Response(), 'address_txs_fragment.html.twig', [
            'address'      => ['addr' => $addr],
            'transactions' => $transactions,
        ]);
    }
}
