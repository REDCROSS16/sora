<?php declare(strict_types=1);

namespace App\Controller\Api\CreateBook;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

readonly class CreateBookManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param Request $request
     * @return int
     */
    public function createBook(Request $request): int
    {
        $author = new Author();
        $author
            ->setName('Alex');

        $this->entityManager->persist($author);

        $book = new Book();
        $book
            ->setTitle('test')
            ->setAuthor($author);

        $this->entityManager->persist($book);
        $this->entityManager->flush();

        return $book->getId();
    }
}