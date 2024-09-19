<?php

namespace App\Controller\Api\FindGoods\OutputDTO;


use App\Entity\Good;

readonly class GoodResult
{
    public function __construct(
        private Good $good,
        private float $score
    )
    {
    }
}