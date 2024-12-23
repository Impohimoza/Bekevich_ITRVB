<?php

namespace App\Repositories\Interfaces;

use App\Models\PostLike;
use App\Models\CommentLike;

interface LikesRepositoryInterface 
{
    public function savePostLike(PostLike $like): void;
    public function getByPostUuid(string $postUuid): array;

    public function saveCommentLike(CommentLike $like): void;
    public function getByCommentUuid(string $commentUuid): array;
}