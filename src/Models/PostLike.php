<?php

namespace App\Models;

class PostLike
{
    public string $uuid;
    public string $postId;
    public string $authorId;

    public function __construct(string $uuid, string $postId, string $authorId)
    {
        $this->uuid = $uuid;
        $this->postId = $postId;
        $this->authorId = $authorId;
    }
}