<?php
namespace App\Service;

use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use App\Event\MyCustomEvent;

class MyEventService
{
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function doSomething()
    {
        // ... Votre logique métier ...

        // Déclencher l'événement
        $event = new MyCustomEvent('Données associées à l\'événement');
        $this->eventDispatcher->dispatch($event);
    }
}