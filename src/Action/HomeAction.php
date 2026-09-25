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
            ['hash' => '000000000000000095ced33b976a18468fad61e83bf19536c910d9ac5294130d', 'height' => 862401, 'time_ago' => '3 min ago',  'tx_count' => 3241, 'size_display' => '1.54 MB', 'miner' => 'Foundry USA'],
            ['hash' => '00000000000000000abc123def456789abc123def456789abc123def456789abc1', 'height' => 862400, 'time_ago' => '14 min ago', 'tx_count' => 2892, 'size_display' => '1.48 MB', 'miner' => 'AntPool'],
            ['hash' => '00000000000000000bcd234ef5678abc234ef5678abc234ef5678abc234ef5678a', 'height' => 862399, 'time_ago' => '22 min ago', 'tx_count' => 1547, 'size_display' => '1.31 MB', 'miner' => 'F2Pool'],
            ['hash' => '00000000000000000cde345fa6789bcd345fa6789bcd345fa6789bcd345fa6789b', 'height' => 862398, 'time_ago' => '31 min ago', 'tx_count' => 4102, 'size_display' => '1.62 MB', 'miner' => 'ViaBTC'],
            ['hash' => '00000000000000000def456ab789acde456ab789acde456ab789acde456ab789ac', 'height' => 862397, 'time_ago' => '45 min ago', 'tx_count' => 2203, 'size_display' => '1.41 MB', 'miner' => 'Foundry USA'],
            ['hash' => '00000000000000000ef5678bc89abdef5678bc89abdef5678bc89abdef5678bc89', 'height' => 862396, 'time_ago' => '52 min ago', 'tx_count' => 3670, 'size_display' => '1.55 MB', 'miner' => 'MARA Pool'],
            ['hash' => '00000000000000000fa6789cd9abcefa6789cd9abcefa6789cd9abcefa6789cd9a', 'height' => 862395, 'time_ago' => '1 hr ago',   'tx_count' => 2981, 'size_display' => '1.50 MB', 'miner' => 'Foundry USA'],
            ['hash' => '000000000000000000b789ade0abcdf0b789ade0abcdf0b789ade0abcdf0b789ad', 'height' => 862394, 'time_ago' => '1 hr ago',   'tx_count' => 1893, 'size_display' => '1.38 MB', 'miner' => 'Binance Pool'],
            ['hash' => '000000000000000000c89abef1bcde01c89abef1bcde01c89abef1bcde01c89abe', 'height' => 862393, 'time_ago' => '1 hr ago',   'tx_count' => 3412, 'size_display' => '1.57 MB', 'miner' => 'AntPool'],
            ['hash' => '000000000000000000d9abcf02cdef12d9abcf02cdef12d9abcf02cdef12d9abcf', 'height' => 862392, 'time_ago' => '2 hr ago',   'tx_count' => 2654, 'size_display' => '1.44 MB', 'miner' => 'F2Pool'],
        ];

        return $this->twig->render(new Response(), 'home.html.twig', [
            'blocks' => $blocks,
        ]);
    }
}
