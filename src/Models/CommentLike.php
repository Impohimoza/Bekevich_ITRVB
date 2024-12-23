<?php

namespace App\Models;

class CommentLike
{
    public string $uuid;
    public string $commentId;
    public string $authorId;

    public function __construct(string $uuid, string $commentId, string $authorId)
    {
        $this->uuid = $uuid;
        $this->commentId = $commentId;
        $this->authorId = $authorId;
    }
}