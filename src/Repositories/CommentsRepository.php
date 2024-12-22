<?php

namespace App\Repositories;

use App\Models\Comment;
use PDO;


class CommentsRepository implements CommentsRepositoryInterface
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function get(string $uuid): ?Comment {
        $stmt = $this->db->prepare('SELECT * FROM comments WHERE uuid = :uuid');
        $stmt->execute(['uuid' => $uuid]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Comment($row['uuid'], $row['author_uuid'], $row['post_uuid'], $row['text']);
    }

    public function save(Comment $comment): void {
        $stmt = $this->db->prepare(
            'INSERT INTO comments (uuid, post_uuid, author_uuid, text) VALUES (:id, :post, :author, :text)'
        );
        $stmt->execute([
            'id' => $comment->uuid,
            'post' => $comment->postId,
            'author' => $comment->authorId,
            'text' => $comment->text,
        ]);
    }
}