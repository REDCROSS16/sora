<?php declare(strict_types=1);

namespace App\Controller\Api\FindGoods\Input;

use Symfony\Component\DependencyInjection\Attribute\Exclude;
use Symfony\Component\Validator\Constraints as Assert;

#[Exclude]
readonly class FindGoodsRequestRange
{
    public function __construct(
        #[Assert\NotBlank()]
        public string $search,
        public bool $activeOnly,
        #[Assert\Type('integer')]
        #[Assert\PositiveOrZero]
        public ?int $minPrice = null,
        #[Assert\Type('integer')]
        #[Assert\PositiveOrZero]
        public ?int $maxPrice = null
    )
    {
    }
}