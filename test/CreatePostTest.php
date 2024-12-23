<?php

use PHPUnit\Framework\TestCase;
use App\Repositories\CommentsRepository;
use App\Repositories\PostRepository;
use App\Models\Post;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface;
use App\Controllers\PostsController;
use App\Repositories\Interfaces\PostsRepositoryInterface;
use GuzzleHttp\Psr7\Utils;
use GuzzleHttp\Psr7\Response;

class CreatePostTest extends TestCase
{
    public function testSuccessfulResponse(): void {
        $request = $this->createMock(Request::class);

        $request->method('getBody')->willReturn(Utils::streamFor(json_encode([
            'author_uuid' => 'c087fcbe-1989-4a37-b099-3be62cf22d5e',
            'title' => 'Test Title',
            'text' => 'Test Content',
        ])));

        $response = new Response();

        $controller = new PostsController();
        $result = $controller->addPost($request, $response);


        $this->assertEquals(201, $result->getStatusCode());
    }

    public function testThrowsExceptionIfPostUuidNotCorrect(): void {
        $request = $this->createMock(Request::class);

        $request->method('getBody')->willReturn(Utils::streamFor(json_encode([
            'author_uuid' => 'Not Correct',
            'title' => 'Test Title',
            'text' => 'Test Content',
        ])));

        $response = new Response();

        $controller = new PostsController();
        $result = $controller->addPost($request, $response);

        $this->assertEquals(400, $result->getStatusCode());
    }

    public function testThrowsExceptionIfPostNotFound(): void {
        $request = $this->createMock(Request::class);

        $request->method('getQueryParams')->willReturn([
            'uuid' => 'Not-Found'
        ]);

        $response = new Response();

        $controller = new PostsController();
        $result = $controller->deletePost($request, $response);

        $this->assertEquals(404, $result->getStatusCode());
    }

    public function testThrowsExceptionIfPostMissingRequiredFields(): void {
        $request = $this->createMock(Request::class);

        $request->method('getBody')->willReturn(Utils::streamFor(json_encode([     //Нет title
            'author_uuid' => '3820d3f2-1d9d-4002-b33c-aede04fefa2b',
            'text' => 'Test Content'
        ])));

        $response = new Response();

        $controller = new PostsController();
        $result = $controller->addPost($request, $response);

        $this->assertEquals(400, $result->getStatusCode());
    }
}