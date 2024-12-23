<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostsRepositoryInterface;
use PDO;
use Exception;


class PostsRepository implements PostsRepositoryInterface
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function get(string $uuid): ?Post {
        $stmt = $this->db->prepare('SELECT * FROM posts WHERE uuid = :uuid');
        $stmt->execute(['uuid' => $uuid]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            throw new Exception('Post not found');
        }

        return new Post($row['uuid'], $row['author_uuid'], $row['title'], $row['text']);
    }

    public function save(Post $post): void {
        $stmt = $this->db->prepare(
            'INSERT INTO posts (uuid, author_uuid, title, text) VALUES (:id, :author, :title, :text)'
        );
        $stmt->execute([
            'id' => $post->uuid,
            'author' => $post->authorId,
            'title' => $post->title,
            'text' => $post->text,
        ]);
    }

    public function delete(string $uuid): void 
    {
        $stmt = $this->db->prepare('DELETE FROM posts WHERE uuid = :uuid');
        $stmt->execute([
            'uuid' => $uuid
        ]);

        if ($stmt->rowCount() === 0) {
            throw new Exception("Post with uuid $uuid not found");
        }
    }
}