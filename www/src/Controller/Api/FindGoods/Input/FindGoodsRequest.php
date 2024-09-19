<?php declare(strict_types=1);

namespace App\Controller\Api\FindGoods\Input;

use Symfony\Component\DependencyInjection\Attribute\Exclude;
use Symfony\Component\Validator\Constraints as Assert;

#[Exclude]
readonly class FindGoodsRequest
{
    public function __construct(
        #[Assert\NotBlank()]
        public string $search,
        public bool $activeOnly
    )
    {
    }
}