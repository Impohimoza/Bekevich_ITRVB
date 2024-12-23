<?php
use PHPUnit\Framework\TestCase;
use App\Models\Comment;
use App\Repositories\CommentsRepository;
use Test\Utils\TestLogger;


class CommentsRepositoryTest extends TestCase
{
    private CommentsRepository $repository;
    private PDO $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->exec("
            CREATE TABLE comments (
                uuid TEXT PRIMARY KEY,
                post_uuid TEXT,
                author_uuid TEXT,
                text TEXT
            );
        ");

        $this->repository = new CommentsRepository($this->pdo, new TestLogger());
    }

    public function testCommentIsSavedInRepository(): void {
        $comment = new Comment('uuid','post-uuid', 'author-uuid', 'Test Comment');
        $this->repository->save($comment);

        $stmt = $this->pdo->query("SELECT * FROM comments WHERE uuid = '{$comment->uuid}'");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertEquals($comment->uuid, $row['uuid']);
        $this->assertEquals('Test Comment', $row['text']);
    }

    public function testRepositoryFindsCommentByUUID(): void {
        $comment = new Comment('uuid', 'post-uuid', 'author-uuid', 'Test Comment');
        $this->repository->save($comment);

        $foundComment = $this->repository->get($comment->uuid);

        $this->assertEquals($comment->uuid, $foundComment->uuid);
        $this->assertEquals($comment->text, $foundComment->text);
    }

    public function testRepositoryThrowsExceptionIfCommentNotFound(): void {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Comment not found');

        $this->repository->get('non-existing-uuid');
    }
}