<?php

declare(strict_types=1);

namespace ChainSpectator\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;
use Slim\Views\Twig;

final readonly class HomeAction implements RequestHandlerInterface
{
    public function __construct(
        private Twig $twig,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $blocks = [
            ['height' => 862401, 'time_ago' => '3 min ago',  'tx_count' => 3241, 'size_display' => '1.54 MB', 'miner' => 'Foundry USA'],
            ['height' => 862400, 'time_ago' => '14 min ago', 'tx_count' => 2892, 'size_display' => '1.48 MB', 'miner' => 'AntPool'],
            ['height' => 862399, 'time_ago' => '22 min ago', 'tx_count' => 1547, 'size_display' => '1.31 MB', 'miner' => 'F2Pool'],
            ['height' => 862398, 'time_ago' => '31 min ago', 'tx_count' => 4102, 'size_display' => '1.62 MB', 'miner' => 'ViaBTC'],
            ['height' => 862397, 'time_ago' => '45 min ago', 'tx_count' => 2203, 'size_display' => '1.41 MB', 'miner' => 'Foundry USA'],
            ['height' => 862396, 'time_ago' => '52 min ago', 'tx_count' => 3670, 'size_display' => '1.55 MB', 'miner' => 'MARA Pool'],
            ['height' => 862395, 'time_ago' => '1 hr ago',   'tx_count' => 2981, 'size_display' => '1.50 MB', 'miner' => 'Foundry USA'],
            ['height' => 862394, 'time_ago' => '1 hr ago',   'tx_count' => 1893, 'size_display' => '1.38 MB', 'miner' => 'Binance Pool'],
            ['height' => 862393, 'time_ago' => '1 hr ago',   'tx_count' => 3412, 'size_display' => '1.57 MB', 'miner' => 'AntPool'],
            ['height' => 862392, 'time_ago' => '2 hr ago',   'tx_count' => 2654, 'size_display' => '1.44 MB', 'miner' => 'F2Pool'],
        ];

        return $this->twig->render(new Response(), 'home.html.twig', [
            'blocks' => $blocks,
        ]);
    }
}
