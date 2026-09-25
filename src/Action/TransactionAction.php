<?php

declare(strict_types=1);

namespace ChainSpectator\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

final readonly class TransactionAction implements RequestHandlerInterface
{
    public function __construct(
        private Twig $twig,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();
        $txid = $route->getArgument('txid');

        $tx = [
            'txid'              => '25226cae007911cc3320ae6c10ad88d55ef2edfc8b0ce6a584051e421e9f925a',
            'confirmed'         => true,
            'confirmations'     => 142,
            'block_height'      => 862401,
            'block_hash'        => '000000000000000095ced33b976a18468fad61e83bf19536c910d9ac5294130d',
            'timestamp'         => '2024-09-15 14:32:01',
            'confirmed_after'   => '8 minutes',
            'features'          => ['SegWit', 'RBF'],
            'fee_sats'          => 1820,
            'fee_fiat'          => '$1.13',
            'fee_rate'          => 12.4,
            'effective_fee_rate' => 12.4,
            'miner'             => 'Foundry USA',
            'size'              => 234,
            'vsize'             => 153,
            'weight'            => 610,
            'version'           => 2,
            'locktime'          => 862399,
            'sigops'            => 1,
            'total_input_btc'   => '0.18300000',
            'total_output_btc'  => '0.18298180',
            'fee_btc'           => '0.00001820',
        ];

        $inputs = [
            [
                'index'    => 0,
                'address'  => 'bc1q3k9pj2w7m4n5q8r6s1t0u2v3x4y5z6a7b8c9d0',
                'value'    => '0.15200000',
                'prev_txid' => 'e3f4a5b6c7d8e9f0a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9b0c1d2e3f4',
                'prev_vout' => 0,
            ],
            [
                'index'    => 1,
                'address'  => 'bc1qj2w7m4n5q8r6s1t0u2v3x4y5z6a7b8c9d0e1f2',
                'value'    => '0.03100000',
                'prev_txid' => 'b7c8d9e0f1a2b3c4d5e6f7a8b9c0d1e2f3a4b5c6d7e8f9a0b1c2d3e4f5a6b7c8',
                'prev_vout' => 2,
            ],
        ];

        $outputs = [
            [
                'index'   => 0,
                'address' => 'bc1qm4n2q8r6s1t0u2v3x4y5z6a7b8c9d0e1f2a3b4',
                'value'   => '0.10000000',
                'spent'   => false,
            ],
            [
                'index'   => 1,
                'address' => 'bc1qp8r1s1t0u2v3x4y5z6a7b8c9d0e1f2a3b4c5d6',
                'value'   => '0.08000000',
                'spent'   => true,
            ],
            [
                'index'   => 2,
                'address' => 'bc1qx5z3u2v3x4y5z6a7b8c9d0e1f2a3b4c5d6e7f8',
                'value'   => '0.00118200',
                'spent'   => true,
            ],
        ];

        return $this->twig->render(new Response(), 'transaction.html.twig', [
            'tx'      => $tx,
            'inputs'  => $inputs,
            'outputs' => $outputs,
        ]);
    }
}
