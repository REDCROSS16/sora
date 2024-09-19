<?php

namespace App\Controller\Api\FindGoods;

use App\Controller\Api\FindGoods\Input\FindGoodsRequest;
use App\Controller\Api\FindGoods\Input\FindGoodsRequestRange;
use App\Controller\Api\FindGoods\OutputDTO\GoodResult;
use App\Entity\Good;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Fuzzy;
use Elastica\Query\Range;
use FOS\ElasticaBundle\Finder\HybridFinderInterface;
use FOS\ElasticaBundle\HybridResult;

readonly class FindGoodsManager
{
    public function __construct(private HybridFinderInterface $finder)
    {
    }

    /**
     * @param FindGoodsRequest $request
     * @return Good[]
     */
    public function findGoods(FindGoodsRequest $request): array
    {
        return array_map(
            static fn(HybridResult $result): GoodResult => new GoodResult(
                good: $result->getTransformed(),
                score: $result->getResult()->getScore()
            ),
            $this->finder->findHybrid($request->search . '~2') # ~2 это морфологическое исправление
        );
        // new Query(new QueryString()
    }

    /**
     * @param FindGoodsRequest $request
     * @return object[]
     */
    public function findGoodsSimple(FindGoodsRequest $request): array
    {
         return $this->finder->find($request->search);
    }


    /**
     * @param FindGoodsRequest $request
     * @return GoodResult[]
     */
    public function findGoodsQuery(FindGoodsRequest $request)
    {
        $boolQuery = new BoolQuery();

        if ($request->activeOnly) {
            $boolQuery->addMust(new Query\Term(['active' => true]));
        }

        $boolQuery->addShould(new Fuzzy('name', $request->search));
        $boolQuery->addShould(new Fuzzy('description', $request->search));

        return array_map(
            static fn (HybridResult $result): GoodResult => new GoodResult(
                $result->getTransformed(),
                $result->getResult()->getScore()
            ),
            $this->finder->findHybrid(new Query($boolQuery))
        );
    }

    public function findGoodQueryFilter(FindGoodsRequestRange $request): array
    {
        $boolQuery = new BoolQuery();

        if ($request->activeOnly) {
            $boolQuery->addMust(new Query\Term(['active' => true]));
        }

        $range = [];

        if ($request->minPrice !== null) {
            $range['gte'] = $request->minPrice; # greater then or equal
        }

        if ($request->maxPrice !== null) {
            $range['lte'] = $request->maxPrice;
        }

        if (count($range) > 0) {
            $boolQuery->addMust(new Range('price' , $range));
        }

        $boolQuery->addShould(new Fuzzy('name', $request->search));
        $boolQuery->addShould(new Fuzzy('description', $request->search));

        return array_map(
            static fn (HybridResult $result): GoodResult => new GoodResult(
                $result->getTransformed(),
                $result->getResult()->getScore()
            ),
            $this->finder->findHybrid(new Query($boolQuery))
        );
    }
}