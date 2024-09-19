<?php

namespace App\Controller\Api\FindGoods;

use App\Controller\Api\FindGoods\Input\FindGoodsRequest;
use phpDocumentor\Reflection\DocBlock\Tags\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class FindGoodsAction
{
    public function __construct(
        private readonly FindGoodsManager $manager,
        private readonly SerializerInterface $serializer
    )
    {
    }

    #[Route('/api/goods', methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] FindGoodsRequest $request): Response
    {
        $result = $this->manager->findGoods($request);

        return  new JsonResponse($this->serializer->serialize(['goods' => $result], JsonEncoder::FORMAT));
    }
}