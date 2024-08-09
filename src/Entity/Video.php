<?php

namespace Alura\Mvc\Entity;

use InvalidArgumentException;

class Video 
{
    public string $url;
    public string $title;
    public int $id;
    public ?string $filePath = null;

    public function __construct(string $url, string $title)
    {
        $this->setUrl($url);
        $this->url = $url;
        $this->title = $title;
    }

    private function setUrl(string $url)
    {

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException();
        }

        $this->url = $url;
    }

    public function setId(int $id): void
    {

        $this->id = $id;
    }

    public function getUrl($url)
    {

        $this->url = $url;
    }

    public function getTitle($title)
    {

        $this->title = $title;
    }

    public function getFilePath(): ?string
    {

        return $this->filePath;
    }

    public function setFilePath(?string $filePath): void
    {

        $this->filePath = $filePath;
    }
}