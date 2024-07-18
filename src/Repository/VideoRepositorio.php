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
        
        $sql = "INSERT INTO videos (url, title) VALUES (?, ?);";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $video->url);
        $statement->bindValue(2, $video->title);

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

        $sql = "UPDATE videos SET url = ?, title = ? WHERE id = ?;";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $video->url);
        $statement->bindValue(2, $video->title);
        $statement->bindValue(3, $video->id);
        
        return $statement->execute();
    }

    public function all(): array 
    {

        $videoList = $this->pdo->query("SELECT * FROM videos;")->fetchAll(PDO::FETCH_ASSOC);

        $videos = array_map(function(array $videoData) {

            $video = new Video($videoData['url'], $videoData['title']);
            $video->setId($videoData['id']);
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

        return $video;
    }
}