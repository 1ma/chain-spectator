<?php

declare(strict_types=1);

namespace ChainSpectator\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

final readonly class BlockAction implements RequestHandlerInterface
{
    public function __construct(
        private Twig $twig,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();
        $blockhash = $route->getArgument('blockhash');

        $block = [
            'hash'           => '000000000000000095ced33b976a18468fad61e83bf19536c910d9ac5294130d',
            'height'         => 862401,
            'timestamp'      => '2024-09-15 14:32:01',
            'size'           => 1543218,
            'weight'         => 3993412,
            'tx_count'       => 3241,
            'fee_span_min'   => 3.1,
            'fee_span_max'   => 412.0,
            'median_fee'     => 12.5,
            'median_fee_fiat' => '$1.23',
            'total_fees_btc' => '0.31200000',
            'total_fees_fiat' => '$19,422',
            'subsidy_btc'    => '3.12500000',
            'reward_btc'     => '3.43700000',
            'reward_fiat'    => '$213,911',
            'miner'          => 'Foundry USA',
            'version'        => '0x20000000',
            'bits'           => '0x17034219',
            'difficulty'     => '57,321,508,229,258',
            'nonce'          => '0xa3f21c08',
            'merkle_root'    => '7a3b1c4d5e6f7a8b9c0d1e2f3a4b5c6d7e8f9a0b1c2d3e4f5a6b7c8d9e0f1a2b',
            'prev_hash'      => '00000000000000000abc123def456789abc123def456789abc123def456789abc1',
            'next_hash'      => '00000000000000000def456789abc123def456789abc123def456789abc123de01',
        ];

        $transactions = [
            [
                'txid' => 'a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9b0c1d2e3f4a5b6c7d8e9f0a1b2',
                'fee'  => 0,
                'fee_rate' => null,
                'inputs' => [
                    ['address' => null, 'value' => null, 'coinbase' => true],
                ],
                'outputs' => [
                    ['address' => 'bc1q7x2m9k3j4n5p6q7r8s9t0u1v2w3x4y5z6a7b8', 'value' => '3.12500000'],
                    ['address' => null, 'value' => null, 'op_return' => true],
                ],
            ],
            [
                'txid' => 'd4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9b0c1d2e3f4a5b6c7d8e9f0a1b2c3d4e5',
                'fee'  => 1820,
                'fee_rate' => 12.0,
                'inputs' => [
                    ['address' => 'bc1q3k9pj2w7m4n5q8r6s1t0u2v3x4y5z6a7b8c9d0', 'value' => '0.15200000'],
                    ['address' => 'bc1qj2w7m4n5q8r6s1t0u2v3x4y5z6a7b8c9d0e1f2', 'value' => '0.03100000'],
                ],
                'outputs' => [
                    ['address' => 'bc1qm4n2q8r6s1t0u2v3x4y5z6a7b8c9d0e1f2a3b4', 'value' => '0.10000000'],
                    ['address' => 'bc1qp8r1s1t0u2v3x4y5z6a7b8c9d0e1f2a3b4c5d6', 'value' => '0.08000000'],
                    ['address' => 'bc1qx5z3u2v3x4y5z6a7b8c9d0e1f2a3b4c5d6e7f8', 'value' => '0.00118200'],
                ],
            ],
            [
                'txid' => 'f8e7d6c5b4a3f2e1d0c9b8a7f6e5d4c3b2a1f0e9d8c7b6a5f4e3d2c1b0a9f8e7',
                'fee'  => 4520,
                'fee_rate' => 28.3,
                'inputs' => [
                    ['address' => 'bc1qa1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9', 'value' => '1.00000000'],
                ],
                'outputs' => [
                    ['address' => 'bc1qb2c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9b0', 'value' => '0.50000000'],
                    ['address' => 'bc1qc3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9b0c1', 'value' => '0.49995480'],
                ],
            ],
        ];

        return $this->twig->render(new Response(), 'block.html.twig', [
            'block'        => $block,
            'transactions' => $transactions,
            'page'         => 1,
            'total_pages'  => 130,
        ]);
    }
}
