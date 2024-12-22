<?php

use PHPUnit\Framework\TestCase;
use App\Models\Comment;
use Ramsey\Uuid\Uuid;

class CommentTest extends TestCase
{
    public function testCommentConstructorSetsProperties(): void
    {
        $comment = new Comment(Uuid::uuid4()->toString(), 'post-uuid', 'author-uuid', 'Text');
        $this->assertEquals('Text', $comment->text);
    }
}