<?php

class Review {
    protected User $user;
    protected Product $product;
    protected string $comment;
    protected int $rating; 

    public function __construct(User $user, Product $product, string $comment, int $rating) 
    {
        $this->user = $user;
        $this->product = $product;
        $this->comment = $comment;
        $this->rating = $rating;
    }

    public function updateComment($comment)
    {
        $this->comment = $comment;
    }

    public function updateRating($rating)
    {
        $this->rating = $rating;
    }
}