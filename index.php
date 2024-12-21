<?php
require_once __DIR__ . '/vendor/autoload.php';
require 'Autoload.php';

use App\User;
use Faker\Factory;

$faker = Factory::create();

$user = new User($faker->randomNumber(), $faker->firstName, $faker->lastName);
echo "User: {$user->firstName} {$user->lastName}";
