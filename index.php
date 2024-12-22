<?php
require_once __DIR__ . '/vendor/autoload.php';
require 'Autoload.php';

use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Repositories\CommentsRepository;

use Faker\Factory;
use Ramsey\Uuid\Uuid;

$faker = Factory::create();

$pdo = new PDO('sqlite:database.sqlite');

$postsRepository = new PostRepository($pdo);
$commentsRepository = new CommentsRepository($pdo);

$post = new Post(Uuid::uuid4()->toString(), Uuid::uuid4()->toString(), $faker->jobTitle, $faker->text);
$postsRepository->save($post); 

$getPost = $postsRepository-> get($post->uuid);
echo "{$post->uuid} {$getPost->title} {$getPost->text} <br>";

$comment = new Comment(Uuid::uuid4()->toString(), Uuid::uuid4()->toString(), $getPost->uuid, $faker->text);
$commentsRepository->save($comment);

$getComment = $commentsRepository-> get($comment->uuid);
echo "{$getComment->postId} {$getComment->text}";