<?php

use PHPUnit\Framework\TestCase;
use App\Models\Post;
use Ramsey\Uuid\Uuid;

class PostTest extends TestCase
{
    public function testPostModel(): void
    {
        $post = new Post(Uuid::uuid4()->toString(), 'author-uuid', 'Title', 'Text');
        $this->assertEquals('Title', $post->title);
        $this->assertEquals('Text', $post->text);
    }
}