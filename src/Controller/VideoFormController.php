<?php
namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepositorio;
use Alura\Mvc\Helper\HtmlRendererTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class VideoFormController implements RequestHandlerInterface
{
    use HtmlRendererTrait;

    public function __construct(private VideoRepositorio $videoRepository)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);
        
        /** @var ?Video $video */
        $video = null;
        if ($id !== false && $id !== null) {
            $video = $this->videoRepository->find($id);
        }
        return new Response(200, body: $this->renderTemplate(
            'formulario',
            ['video' => $video,]
        ));
    }
}