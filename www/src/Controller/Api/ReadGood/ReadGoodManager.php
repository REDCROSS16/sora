<?php declare(strict_types=1);

namespace App\Controller\Api\ReadGood;

use App\Entity\Good;
use Doctrine\ORM\EntityManagerInterface;

readonly class ReadGoodManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param int $id
     * @return Good|null
     */
    public function getGood(int $id): ?Good
    {
        $goodRepository = $this->entityManager->getRepository(Good::class);
        /** @var Good|null $good */
        $good = $goodRepository->find($id);

        return $good;
    }
}