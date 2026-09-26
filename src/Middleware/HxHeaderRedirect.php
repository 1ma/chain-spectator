<?php

namespace ChainSpectator\Middleware;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

final readonly class HxHeaderRedirect implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!$request->hasHeader('HX-Request')) {
            return new Response(StatusCodeInterface::STATUS_FOUND, new Headers(['Location' => '/']));
        }

        return $handler->handle($request);
    }
}
