<?php

namespace App\Repositories\Interfaces;

use App\Models\Post;

interface PostsRepositoryInterface 
{
    public function get(string $uuid): ?Post; 
    public function save(Post $post): void; 
}