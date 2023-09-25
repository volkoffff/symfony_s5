<?php

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;

class MyCustomEvent extends Event
{
    private $data;

    public function __construct($data)
    {
    $this->data = $data;
    }

    public function getData()
    {
    return $this->data;
    }
}