<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepositorio;

class EditVideoController implements Controller
{
    public function __construct(private VideoRepositorio $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id === null) {
            header('Location: /?sucesso=0');
            return;
        }

        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        if ($url === false) {
            header('Location: /?sucesso=0');
            return;
        }
        $titulo = filter_input(INPUT_POST, 'titulo');
        if ($titulo === false) {
            header('Location: /?sucesso=0');
            return;
        }

        $video = new Video($url, $titulo);
        $video->setId($id);

        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileTempName = uniqid('upload_') . '_' . pathInfo($_FILES['image']['name'], PATHINFO_BASENAME);
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mineType = $finfo->file($_FILES['image']['tmp_name']);

            if(str_starts_with($mineType, 'image/')){
                move_uploaded_file(
                    $_FILES['image'] ['tmp_name'],
                    __DIR__ . '/../../public/img/uploads/' . $fileTempName
                );
                $video->setFilePath($fileTempName);
            }
        }

        $success = $this->videoRepository->updateVideo($video);

        if ($success === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }
}