<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepositorio;

class VideoListController extends ControllerWithHtml implements Controller
{
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