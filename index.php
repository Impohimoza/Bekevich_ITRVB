<?php
require_once __DIR__ . '/vendor/autoload.php';

use Slim\Factory\AppFactory;
use App\Controllers\CommentsController;
use App\Controllers\PostsController;

$app = AppFactory::create();

$app->post('/posts/comment', [CommentsController::class, 'addComment']);
$app->post('/posts', [PostsController::class, 'addPost']);
$app->delete('/posts', [PostsController::class, 'deletePost']);

$app->run();