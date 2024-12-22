<?php
namespace App\Models;

use Ramsey\Uuid\Uuid;

class Comment 
{
    public string $uuid;
    public string $authorId;
    public string $postId;
    public string $text;

    public function __construct(string $uuid, string $authorId, string $postId, string $text) 
    {
        $this->uuid = $uuid;
        $this->authorId = $authorId;
        $this->postId = $postId;
        $this->text = $text;
    }
}
