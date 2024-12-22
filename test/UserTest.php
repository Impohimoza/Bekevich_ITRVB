<?php

use PHPUnit\Framework\TestCase;
use App\Models\User;
use Ramsey\Uuid\Uuid;

class UserTest extends TestCase
{
    public function testUserConstructorSetsProperties(): void
    {
        $user = new User(Uuid::uuid4()->toString(), 'username', 'first', 'last');
        $this->assertEquals('username', $user->username);
        $this->assertEquals('first', $user->firstName);
        $this->assertEquals('last', $user->lastName);
    }
}