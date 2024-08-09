<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\HtmlRendererTrait;
use Alura\Mvc\Repository\VideoRepositorio;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class VideoListController implements RequestHandlerInterface
{
    public function __construct(private VideoRepositorio $videoRepository, private Engine $templates)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $videos = $this->videoRepository->all();
        return new Response(200, body: $this->templates->render(
            'listagem-videos',
            ['videos' => $videos]
        ));
    }
}
