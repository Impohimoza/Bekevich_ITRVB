<?php
namespace App\Models;

use Ramsey\Uuid\Uuid;

class Post 
{
    public string $uuid;
    public string $authorId;
    public string $title;
    public string $text;

    public function __construct(string $uuid, string $authorId, string $title, string $text) 
    {
        $this->uuid = $uuid;
        $this->authorId = $authorId;
        $this->title = $title;
        $this->text = $text;
    }
}
