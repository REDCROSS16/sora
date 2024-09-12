<?php declare(strict_types=1);

namespace App\Controller\Api\UpdateGood\Input;

use Symfony\Component\DependencyInjection\Attribute\Exclude;
use Symfony\Component\Validator\Constraints as Assert;

#[Exclude]
readonly class UpdateGoodRequest
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Type('integer')]
        #[Assert\Positive]
        public int $id,
        #[Assert\NotBlank]
        public string $name,
        #[Assert\NotBlank]
        #[Assert\Type('integer')]
        #[Assert\Positive]
        public int $price,
        #[Assert\NotBlank]
        public string $description,
        #[Assert\Type('boolean')]
        public bool $isActive,
    ) {
    }
}