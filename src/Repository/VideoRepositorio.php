<?php

namespace Alura\Mvc\Repository;

use Alura\Mvc\Entity\Video;
use PDO;

class VideoRepositorio 
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addVideo(Video $video): bool
    {
        
        $sql = "INSERT INTO videos (url, title, image_path) VALUES (?, ?, ?);";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $video->url);
        $statement->bindValue(2, $video->title);
        $statement->bindValue(3, $video->filePath);

        $result = $statement->execute();

        $id = $this->pdo->lastInsertId();
        $video->setId(intval($id));

        return $result;
    }

    public function removeVideo(int $id): bool 
    {
        
        $sql = "DELETE FROM videos WHERE id = ?;";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);

        return $statement->execute();
    }

    public function updateVideo(Video $video): bool 
    {
        $updateImageSql = '';
        if ($video->getFilePath() !== null) {
            $updateImageSql = ', image_path = :image_path';
        }
        $sql = "UPDATE videos SET
                url = :url,
                title = :title
                $updateImageSql
            WHERE id = :id;";
        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(':url', $video->url);
        $statement->bindValue(':title', $video->title);
        $statement->bindValue(':id', $video->id, PDO::PARAM_INT);

        if ($video->getFilePath() !== null) {
            $statement->bindValue(':image_path', $video->getFilePath());
        }

        return $statement->execute();
    }

    public function all(): array 
    {

        $videoList = $this->pdo->query("SELECT * FROM videos;")->fetchAll(PDO::FETCH_ASSOC);

        $videos = array_map(function(array $videoData) {

            $video = new Video($videoData['url'], $videoData['title']);
            $video->setId($videoData['id']);
            $video->setFilePath($videoData['image_path']);
            return $video;
        }, $videoList);

        return $videos;
    }
    
    public function find(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM videos WHERE id = ?;');
        $statement->bindValue(1, $id, \PDO::PARAM_INT);
        $statement->execute();

        return $this->hydrateVideo($statement->fetch(\PDO::FETCH_ASSOC));
    }

    private function hydrateVideo(array $videoData): Video
    {
        $video = new Video($videoData['url'], $videoData['title']);
        $video->setId($videoData['id']);
        if ($videoData['image_path'] !== null) {
            $video->setFilePath($videoData['image_path']);
        }

        return $video;
    }
}