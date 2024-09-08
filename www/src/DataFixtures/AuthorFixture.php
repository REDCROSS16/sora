<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class AuthorFixture extends Fixture implements DependentFixtureInterface
{
    public const string AUTHOR_REFERENCE_PREFIX = 'author_';

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $author = new Author();
            $author->setName("Author $i");
            $this->addReference(self::AUTHOR_REFERENCE_PREFIX . $i, $author);

            // Присоединяем случайные теги к автору
            for ($j = 1; $j <= 3; $j++) {
                if (rand(0, 1)) {
                    $tag = $this->getReference(TagFixture::TAG_REFERENCE_PREFIX . $j);
                    $author->getTags()->add($tag);
                    $tag->getAuthors()->add($author);
                }
            }

            // Создаем книги для автора
            for ($j = 1; $j <= 2; $j++) {
                $book = new Book();
                $book->setTitle("Book $j by Author $i");
                $book->setAuthor($author);
                $manager->persist($book);
                $author->getBooks()->add($book);
            }

            $manager->persist($author);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TagFixture::class,
        ];
    }
}