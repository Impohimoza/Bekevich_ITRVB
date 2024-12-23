<?php
require_once __DIR__ . '/vendor/autoload.php';

use Slim\Factory\AppFactory;
use App\Controllers\CommentsController;
use App\Controllers\PostsController;
use App\Controllers\LikesController;

$app = AppFactory::create();

$app->post('/posts/comment', [CommentsController::class, 'addComment']);
$app->post('/posts', [PostsController::class, 'addPost']);
$app->delete('/posts', [PostsController::class, 'deletePost']);
$app->post('/posts/like', [LikesController::class, 'createPostLike']);
$app->post('/posts/comment/like', [LikesController::class, 'createCommentLike']);

$app->run();