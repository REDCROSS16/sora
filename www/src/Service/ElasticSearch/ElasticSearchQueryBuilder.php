<?php declare(strict_types=1);

namespace App\Service\ElasticSearch;

class ElasticSearchQueryBuilder
{
    protected array $query = [
        'query' => [
            'bool' => [
                'must' => [],
                'filter' => [],
            ],
        ],
    ];

    /**
     * @param string $field
     * @param string $value
     * @return $this
     */
    public function match(string $field, string $value): static
    {
        $this->query['query']['bool']['must'][] = [
            'match' => [
                $field => $value,
            ],
        ];

        // ['should'] или?
        // ['must_not'] или?

        return $this;
    }

    /**
     * @return array|array[]
     */
    public function matchAll(): array
    {
        $this->query['query'] = [
            'match_all' => (object)[]
        ];

        return $this->get();
    }

    /**
     * @param string $field
     * @param string $value
     * @return $this
     */
    public function filter(string $field, string $value): static
    {
        $this->query['query']['bool']['filter'][] = [
            'term' => [
                $field => $value,
            ],
        ];

        return $this;
    }

    /**
     * @param string $field
     * @param string $order
     * @return $this
     */
    public function sort(string $field, string $order = 'asc'): static
    {
        $this->query['sort'][] = [
            $field => [
                'order' => $order,
            ],
        ];
        return $this;
    }

    /**
     * @param int $size
     * @return $this
     */
    public function size(int $size): static
    {
        $this->query['size'] = $size;

        return $this;
    }

    /**
     * @param int $from
     * @return $this
     */
    public function from(int $from): static
    {
        $this->query['from'] = $from;

        return $this;
    }

    /**
     * @param array $aggregateArray
     * @return $this
     */
    public function aggregate(array $aggregateArray): static
    {
        $this->query['aggs'] = $aggregateArray;

        return $this;
    }

    /**
     * @return array|array[]
     */
    public function get(): array
    {
        return $this->query;
    }
}