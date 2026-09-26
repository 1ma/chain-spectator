<?php

declare(strict_types=1);

namespace ChainSpectator\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

final readonly class AddressAction implements RequestHandlerInterface
{
    public function __construct(
        private Twig $twig,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();
        $addr = $route->getArgument('addr');

        $address = [
            'addr'              => 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh',
            'type'              => 'P2WPKH (native SegWit)',
            'confirmed_balance' => '1.45000000',
            'confirmed_fiat'    => '$90,219',
            'pending_balance'   => '+0.05000000',
            'pending_fiat'      => '$3,111',
            'confirmed_utxos'   => 12,
            'pending_utxos'     => 1,
            'total_received'    => '8.21000000',
            'total_received_fiat' => '$510,744',
            'tx_count'          => 156,
        ];

        $transactions = [
            [
                'txid'      => 'd4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9b0c1d2e3f4a5b6c7d8e9f0a1b2c3d4e5',
                'timestamp' => '2024-09-15 14:32',
                'fee'       => 1820,
                'fee_rate'  => 12.0,
                'inputs'    => [
                    ['address' => 'bc1q3k9pj2w7m4n5q8r6s1t0u2v3x4y5z6a7b8c9d0', 'value' => '0.15200000'],
                    ['address' => 'bc1qj2w7m4n5q8r6s1t0u2v3x4y5z6a7b8c9d0e1f2', 'value' => '0.03100000'],
                ],
                'outputs' => [
                    ['address' => 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh', 'value' => '0.10000000'],
                    ['address' => 'bc1qp8r1s1t0u2v3x4y5z6a7b8c9d0e1f2a3b4c5d6', 'value' => '0.08000000'],
                    ['address' => 'bc1qx5z3u2v3x4y5z6a7b8c9d0e1f2a3b4c5d6e7f8', 'value' => '0.00118200'],
                ],
            ],
            [
                'txid'      => 'a9b8c7d6e5f4a3b2c1d0e9f8a7b6c5d4e3f2a1b0c9d8e7f6a5b4c3d2e1f0a9b8',
                'timestamp' => '2024-09-14 09:11',
                'fee'       => 940,
                'fee_rate'  => 6.0,
                'inputs'    => [
                    ['address' => 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh', 'value' => '0.20000000'],
                ],
                'outputs' => [
                    ['address' => 'bc1qr9s0t1u2v3w4x5y6z7a8b9c0d1e2f3a4b5c6d7', 'value' => '0.19500000'],
                    ['address' => 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh', 'value' => '0.00406000'],
                ],
            ],
            [
                'txid'      => 'f1e2d3c4b5a6f7e8d9c0b1a2f3e4d5c6b7a8f9e0d1c2b3a4f5e6d7c8b9a0f1e2',
                'timestamp' => '2024-09-12 21:45',
                'fee'       => 3150,
                'fee_rate'  => 18.5,
                'inputs'    => [
                    ['address' => 'bc1qa1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9', 'value' => '1.00000000'],
                ],
                'outputs' => [
                    ['address' => 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh', 'value' => '0.50000000'],
                    ['address' => 'bc1qb2c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9b0', 'value' => '0.49685000'],
                ],
            ],
        ];

        return $this->twig->render(new Response(), 'address.html.twig', [
            'address'      => $address,
            'transactions' => $transactions,
            'shown'        => count($transactions),
        ]);
    }
}
