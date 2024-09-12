<?php declare(strict_types=1);

namespace App\Controller\Api\DeleteGood;

use App\Entity\Good;
use Doctrine\ORM\EntityManagerInterface;

readonly class DeleteGoodManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteGood(int $id): bool
    {
        $goodRepository = $this->entityManager->getRepository(Good::class);
        $good = $goodRepository->find($id);

        if ($good === null) {
            return false;
        }

        $this->entityManager->remove($good);
        $this->entityManager->flush();

        return true;
    }
}