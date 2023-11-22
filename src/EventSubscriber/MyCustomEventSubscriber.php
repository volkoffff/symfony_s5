<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Event\MyCustomEvent;

class MyCustomEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            MyCustomEvent::class => 'onMyCustomEvent',
        ];
    }

    public function onMyCustomEvent(MyCustomEvent $event)
    {
        // Effectuez des actions en réponse à l'événement
        $data = $event->getData();
        // ... Faites quelque chose avec $data ...
    }
}
