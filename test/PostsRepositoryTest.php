<?php

use PHPUnit\Framework\TestCase;
use App\Models\Post;
use App\Repositories\PostsRepository;


class PostsRepositoryTest extends TestCase
{
    private PostsRepository $repository;
    private PDO $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->exec("
            CREATE TABLE posts (
                uuid TEXT PRIMARY KEY,
                author_uuid TEXT,
                title TEXT,
                text TEXT
            );
        ");

        $this->repository = new PostsRepository($this->pdo);
    }

    public function testPostIsSavedInRepository(): void 
    {
        $post = new Post('uuid', 'author-uuid', 'Test Title', 'Test Content');
        $this->repository->save($post);

        $stmt = $this->pdo->query("SELECT * FROM posts WHERE uuid = '{$post->uuid}'");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertEquals($post->uuid, $row['uuid']);
        $this->assertEquals('Test Title', $row['title']);
        $this->assertEquals('Test Content', $row['text']);
    }

    public function testRepositoryFindsPostByUUID(): void 
    {
        $post = new Post('uuid', 'author-uuid', 'Test Title', 'Test Content');
        $this->repository->save($post);

        $foundPost = $this->repository->get($post->uuid);

        $this->assertEquals($post->uuid, $foundPost->uuid);
        $this->assertEquals($post->title, $foundPost->title);
    }

    public function testRepositoryThrowsExceptionIfPostNotFound(): void {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Post not found');

        $this->repository->get('non-existing-uuid');
    }
}