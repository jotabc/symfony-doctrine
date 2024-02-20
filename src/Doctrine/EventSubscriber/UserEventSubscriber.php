<?php

namespace App\Doctrine\EventSubscriber;

use App\Entity\User;
use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;

class UserEventSubscriber implements EventSubscriber
{
    public function __construct(
        private LoggerInterface $loggerInterface
    ) {
        
    }

    public function getSubscribedEvents(): array
    {
        return array(
            Events::preUpdate,
        );
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof User) {
            $this->loggerInterface->info(\sprintf('User, has been updated. New name: %s', $entity->getName()));
        }
        
    }
}
