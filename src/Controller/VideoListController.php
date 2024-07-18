<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepositorio;

class VideoListController
{
    public function __construct(private VideoRepositorio $videoRepository)
    {
        
    }

    public function processaRequisicao(): void
    {
        $videos = $this->videoRepository->all();
        require_once __DIR__ . "/../../view/listagem-videos.php";
        
    }
}