<?php
class FeedbackForm {
    public $name;
    public $email;
    public $message;

    public function __construct($name, $email, $message) 
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    public function sendMessage() 
    {
        return "Сообщение от {$this->name} отправлено.";
    }
}