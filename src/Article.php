<?php
namespace App;

class Article 
{
    public int $id;
    public int $authorId;
    public string $title;
    public string $text;

    public function __construct(int $id, int $authorId, string $title, string $text) 
    {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->title = $title;
        $this->text = $text;
    }
}
