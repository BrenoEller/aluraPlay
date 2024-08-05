<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepositorio;
use Alura\Mvc\Helper\HtmlRendererTrait;

class VideoListController implements Controller
{
    use HtmlRendererTrait;

    public function __construct(private VideoRepositorio $videoRepository)
    {
        
    }

    public function processaRequisicao(): void
    {
        $videos = $this->videoRepository->all();
        echo $this->renderTemplate(
            'listagem-videos',
            ['videos' => $videos]
        );
    }
}