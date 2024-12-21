<?php

class User {
    protected string $name;
    protected string $email;
    protected string $password;


    public function __construct(string $name, string $email, string $password) {
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
}

class Admin extends User
{
    protected string $role = 'Admin';

    public function deleteUser(User $user) 
    {
        return "Пользователь {$user->name} удалён.";
    }
}