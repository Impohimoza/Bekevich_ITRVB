<?php

namespace App\Controllers;

use App\Repositories\CommentsRepository;
use App\Models\Comment;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PDO;
use Ramsey\Uuid\Uuid;

class CommentsController
{
    private CommentsRepository $repository;

    public function __construct()
    {
        $this->repository= new CommentsRepository(new PDO('sqlite:database.sqlite'));
    }

    public function addComment (Request $request, Response $response): Response
    {
        $data = json_decode($request->getBody()->getContents(), true);

        if(empty($data['author_uuid']) || empty($data['post_uuid']) || empty($data['text']))
        {
            $response->getBody()->write(json_encode( ['status' => 'error', 'message' => 'Missing required fields']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        if (!Uuid::isValid($data['author_uuid']) || !Uuid::isValid($data['post_uuid'])) 
        {
            $response->getBody()->write(json_encode( ['status' => 'error', 'message' => 'Invalid UUID format']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        try {
            $comment = new Comment(Uuid::uuid4(), $data['post_uuid'], $data['author_uuid'], $data['text']);
            $this->repository->save($comment);

            $response->getBody()->write(json_encode( ['message' => 'Comment added', 'comment' => $comment]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
        } catch (\Exception $e) 
        {
            $response->getBody()->write(json_encode( ['error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }
    }
}