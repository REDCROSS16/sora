<?php declare(strict_types=1);

namespace App\Service;

interface SearchServiceInterface
{
    public function createIndex(string $index, array $settings): mixed;
    public function indexDocument(string $index, string $id, array $document): mixed;
    public function search(array $params): mixed;
}