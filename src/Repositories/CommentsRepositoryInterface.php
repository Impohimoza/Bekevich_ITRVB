<?php

namespace App\Repositories;

use App\Models\Comment;

interface CommentsRepositoryInterface {
    public function get(string $uuid): ?Comment;
    public function save(Comment $comment): void;
}