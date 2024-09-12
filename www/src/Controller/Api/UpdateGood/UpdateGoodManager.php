<?php declare(strict_types=1);

namespace App\Controller\Api\UpdateGood;

use App\Controller\Api\UpdateGood\Input\UpdateGoodRequest;
use App\Entity\Good;
use Doctrine\ORM\EntityManagerInterface;

readonly class UpdateGoodManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function updateGood(UpdateGoodRequest $request): bool
    {
        $goodRepository = $this->entityManager->getRepository(Good::class);
        $good = $goodRepository->find($request->id);

        if ($good === null) {
            return false;
        }

        $good
            ->setName($request->name)
            ->setPrice($request->price)
            ->setDescription($request->description)
            ->setIsActive($request->isActive);

        $this->entityManager->flush();

        return true;
    }
}