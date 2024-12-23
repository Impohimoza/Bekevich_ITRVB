<?php

namespace App\Controllers;

use App\Repositories\PostsRepository;
use App\Models\Post;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PDO;
use Ramsey\Uuid\Uuid;
use Exception;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class PostsController
{
    private PostsRepository $repository;

    public function __construct()
    {
        $logger = new Logger('posts');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../../logs/app.log', Logger::INFO));
        $this->repository= new PostsRepository(new PDO('sqlite:database.sqlite'), $logger);
    }

    public function addPost (Request $request, Response $response): Response
    {
        $data = json_decode($request->getBody()->getContents(), true);

        if(empty($data['author_uuid']) || empty($data['title']) || empty($data['text']))
        {
            $response->getBody()->write(json_encode( ['status' => 'error', 'message' => 'Missing required fields']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        if (!Uuid::isValid($data['author_uuid'])) 
        {
            $response->getBody()->write(json_encode( ['status' => 'error', 'message' => 'Invalid UUID format']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        try {
            $post = new Post(Uuid::uuid4(), $data['author_uuid'], $data['title'], $data['text']);
            $this->repository->save($post);

            $response->getBody()->write(json_encode( ['message' => 'Post added', 'post' => $post]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
        } catch (\Exception $e) 
        {
            $response->getBody()->write(json_encode( ['error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }
    }

    public function deletePost (Request $request, Response $response): Response
    {
        $uuid = $request->getQueryParams()['uuid'] ?? null;

        if (!$uuid) {
            $result = ['status' => 'error', 'message' => 'UUID is required'];
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        try {
            $this->repository->delete($uuid);
            $response->getBody()->write(json_encode(['status' => 'success', 'message' => 'Post deleted']));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['status' => 'error', 'message' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
    }
}