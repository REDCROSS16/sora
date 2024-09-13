<?php

namespace App\Listener;

use App\Entity\Book;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use FOS\ElasticaBundle\Persister\ObjectPersister;
use Psr\Log\LoggerInterface;

class BookListener
{
    public function __construct (
        readonly private ObjectPersister $persister,
        readonly private LoggerInterface $logger
    )
    {
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof Book) {
            $this->persister->insertOne($entity);
            $this->logger->info('Entity was changed');
        }

        $this->logger->info('Exit from listener');
    }

    /**
     * @param LifecycleEventArgs $args
     * @return void
     */
    public function postUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof Book) {
            $this->persister->insertOne($entity);
        }
    }
}