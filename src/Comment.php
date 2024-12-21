<?php
namespace App;

class Comment 
{
    public int $id;
    public int $authorId;
    public int $articleId;
    public string $text;

    public function __construct(int $id, int $authorId, int $articleId, string $text) 
    {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->articleId = $articleId;
        $this->text = $text;
    }
}
