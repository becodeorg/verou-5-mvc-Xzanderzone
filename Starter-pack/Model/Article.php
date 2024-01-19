<?php

declare(strict_types=1);

class Article
{
    public string $title;
    public string $description;
    public string $publishDate;
    public string $image;
    private int $id;

    public function __construct(int $id, string $title, string $description, string $publishDate, $image = "")
    {
        $this->title = $title;
        $this->description = $description;
        $this->publishDate = $publishDate;
        $this->image = $image;
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function formatPublishDate($format = 'd-M-Y')
    {
        // TODO: return the date in the required format
        $dateTime = new DateTime($this->publishDate);

        return $dateTime->format($format);
    }
}