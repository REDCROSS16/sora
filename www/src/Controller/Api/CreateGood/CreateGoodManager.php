<?php declare(strict_types=1);

namespace App\Controller\Api\CreateGood;

use App\Controller\Api\CreateGood\Input\CreateGoodRequest;
use App\Entity\Good;
use Doctrine\ORM\EntityManagerInterface;

readonly class CreateGoodManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param CreateGoodRequest $request
     * @return int
     */
    public function createGood(CreateGoodRequest $request): int
    {
        $good = new Good();
        $good
            ->setName($request->name)
            ->setPrice($request->price)
            ->setDescription($request->description)
            ->setIsActive(true);

        $this->entityManager->persist($good);
        $this->entityManager->flush();

        return $good->getId();
    }
}