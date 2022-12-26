<?php
namespace App\EventSubscriber;

use App\Entity\Category;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setCreatedAt'],
        ];
    }

    public function setCreatedAt(BeforeEntityPersistedEvent $event)
    {
        $entityInstance = $event->getEntityInstance();

        if (!($entityInstance instanceof Product) && !($entityInstance instanceof Category)) return;
        if(!$entityInstance->getCreatedAt()) $entityInstance->setCreatedAt(new \DateTimeImmutable);
    }
}
