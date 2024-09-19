<?php

/**
 * Created by PhpStorm
 * User: red
 * Date: 15.09.2024
 * Time: 12:29
 * Project: sora
 */

declare(strict_types=1);

namespace BookTest;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Book;

class BooksTest extends ApiTestCase
{
    public function testCreateBook(): void
    {
        $response = static::createClient()->request('GET', '/authors', ['json' => [
            'id' => 1,
        ]]);

        dd($response);

        $this->assertResponseStatusCodeSame(404);



//        $this->assertResponseStatusCodeSame(201);
//        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
//        $this->assertJsonContains([
//            '@context' => '/contexts/Book',
//            '@type' => 'Book',
//            'isbn' => '0099740915',
//            'title' => 'The Handmaid\'s Tale',
//            'description' => 'Brilliantly conceived and executed, this powerful evocation of twenty-first century America gives full rein to Margaret Atwood\'s devastating irony, wit and astute perception.',
//            'author' => 'Margaret Atwood',
//            'publicationDate' => '1985-07-31T00:00:00+00:00',
//            'reviews' => [],
//        ]);
//        $this->assertMatchesRegularExpression('~^/books/\d+$~', $response->toArray()['@id']);
//        $this->assertMatchesResourceItemJsonSchema(Book::class);
    }
}