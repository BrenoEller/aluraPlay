<?php
namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepositorio;
use Alura\Mvc\Helper\HtmlRendererTrait;

class VideoFormController implements Controller
{
    use HtmlRendererTrait;

    public function __construct(private VideoRepositorio $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        /** @var ?Video $video */
        $video = null;
        if ($id !== false && $id !== null) {
            $video = $this->videoRepository->find($id);
        }

        echo $this->renderTemplate('formulario', [
            'video' => $video,
        ]);
    }
}