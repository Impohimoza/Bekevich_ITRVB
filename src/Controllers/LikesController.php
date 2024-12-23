<?php

namespace App\Controllers;

use App\Repositories\LikesRepository;
use App\Models\CommentLike;
use App\Models\PostLike;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PDO;
use Ramsey\Uuid\Uuid;
use Exception;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LikesController
{
    private LikesRepository $repository;

    public function __construct()
    {
        $logger = new Logger('likes');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../../logs/app.log', Logger::INFO));
        $this->repository= new LikesRepository(new PDO('sqlite:database.sqlite'), $logger);
    }

    public function createPostLike(Request $request, Response $response)
    {
        $data = json_decode($request->getBody()->getContents(), true);


        if (empty($data['post_uuid']) || empty($data['author_uuid']))
        {
            $response->getBody()->write(json_encode( ['status' => 'error', 'message' => 'Missing required fields']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $existingLikes = $this->repository->getByPostUuid($data['post_uuid']);

        foreach ($existingLikes as $like) 
        {
            if ($like['author_uuid'] === $data['author_uuid']) 
            {
                $response->getBody()->write(json_encode( ['error' => 'User already liked this post']));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(409);
            }
        }

        $like = new PostLike(Uuid::uuid4()->toString(), $data['post_uuid'], $data['author_uuid']);
        $this->repository->savePostLike($like);

        $response->getBody()->write(json_encode( ['message' => 'Like added successfully']));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function createCommentLike(Request $request, Response $response)
    {
        $data = json_decode($request->getBody()->getContents(), true);


        if (empty($data['comment_uuid']) || empty($data['author_uuid']))
        {
            $response->getBody()->write(json_encode( ['status' => 'error', 'message' => 'Missing required fields']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $existingLikes = $this->repository->getByCommentUuid($data['comment_uuid']);

        foreach ($existingLikes as $like) 
        {
            if ($like['author_uuid'] === $data['author_uuid']) 
            {
                $response->getBody()->write(json_encode( ['error' => 'User already liked this post']));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(409);
            }
        }

        $like = new CommentLike(Uuid::uuid4()->toString(), $data['comment_uuid'], $data['author_uuid']);
        $this->repository->saveCommentLike($like);

        $response->getBody()->write(json_encode( ['message' => 'Like added successfully']));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}