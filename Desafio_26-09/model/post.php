<?php

class Post
{

    private $title;
    private $userName;
    private $text;
    private $timestamp;
    private $pv;

    public function __construct($title, $userName, $text)
    {
        $this->pv = new PostValidator();

        $this->setTitle($title);
        $this->setUserName($userName);
        $this->setText($text);
        $this->setTimestamp();
    }

    public function setTitle($title) {
        if (!$this->pv->isTitleValid($title))
            throw new RequestException("400", "Bad request");

        $this->title = $title;
    }

    public function setUserName($userName) {
        if (!$this->pv->isTitleValid($userName))
            throw new RequestException("400", "Bad request");

        $this->userName = $userName;
    }

    public function setText($text) {
        if (!$this->pv->isTitleValid($text))
            throw new RequestException("400", "Bad request");

        $this->text = $text;
    }

    public function setTimestamp() {
        $this->timestamp = (new DateTime)->getTimestamp();
    }

    public function getTimestamp() {
        return $this->timestamp;
    }
}
