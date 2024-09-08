<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $author = $this->getReference(AuthorFixture::AUTHOR_REFERENCE_PREFIX . rand(1, 5));

            $book = new Book();
            $book->setTitle("Additional Book $i");
            $book->setAuthor($author);
            $manager->persist($book);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AuthorFixture::class
        ];
    }
}