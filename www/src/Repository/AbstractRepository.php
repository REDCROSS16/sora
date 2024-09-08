<?php declare(strict_types=1);

namespace App\Repository;

use App\Repository\Exception\CannotBuildRepositoryException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Driver\PDO\Exception;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

abstract class AbstractRepository extends ServiceEntityRepository
{
    protected readonly LoggerInterface $logger;
    protected readonly Security $security;
    protected readonly EventDispatcherInterface $eventDispatcher;

    /**
     * @param ManagerRegistry $registry
     * @param LoggerInterface $logger
     * @param Security $security
     * @param EventDispatcherInterface $eventDispatcher
     * @throws Exception
     */
    public function __construct(
        ManagerRegistry $registry,
        LoggerInterface $logger,
        Security $security,
        EventDispatcherInterface $eventDispatcher,
    ) {
        $this->logger = $logger;
        $this->security = $security;
        $this->eventDispatcher = $eventDispatcher;

        if (!class_exists($entityClassName = $this->getEntityClassName())) {
            throw new Exception(" Entity \"{$entityClassName}\" does not exist");
        }

        parent::__construct($registry, $entityClassName);
    }


    /**
     * @param QueryBuilder $qb
     * @param bool $useCache
     * @return Query
     */
    protected function getQuery(QueryBuilder $qb, bool $useCache = false): Query
    {
        $query = $qb->getQuery();

        return $useCache ? $query->enableResultCache() : $query->disableResultCache();

    }

    /**
     * @return string
     * @throws \Exception
     */
    protected function getEntityClassName(): string
    {
        $repositoryNameParts = explode('\\', \get_class($this));
        $repositoryName = end($repositoryNameParts);

        if (!str_contains($repositoryName, 'Repository')) {
            throw new Exception(' Non-standard repository name given. Repository must be named like "EntityNameRepository"');
        }

        return 'App\Entity\\' . str_replace('Repository', '', $repositoryName);
    }

    /**
     * @param QueryBuilder $qb
     * @param bool $useCache
     * @return array
     */
    protected function getResult(QueryBuilder $qb, bool $useCache = false): array
    {
        try {
            $result = $this->getQuery($qb, $useCache)->getResult();
        } catch (\Exception $ex) {
            $this->logger->error($ex->getFile() . "({$ex->getLine()}): {$ex->getMessage()}");
            $result = [];
        }

        return $result;
    }
}