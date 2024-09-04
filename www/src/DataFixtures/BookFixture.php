<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookFixture extends Fixture implements DependentFixtureInterface
{
    public const string BOOK_ONE = 'book_one';
    public const string BOOK_TWO = 'book_two';
    public const string BOOK_THREE = 'book_three';

    /**
     * @inheritDoc
     */
    #[\Override]
    public function load(ObjectManager $manager): void
    {
        $authorOne = $this->getReference(AuthorFixture::AUTHOR_ONE);
        $authorTwo = $this->getReference(AuthorFixture::AUTHOR_TWO);
        $authorThree = $this->getReference(AuthorFixture::AUTHOR_THREE);

        $bookOne = new Book();
        $bookOne
            ->setTitle('Book one')
            ->setAuthor($authorOne);
        $manager->persist($bookOne);
        $this->addReference(self::BOOK_ONE, $bookOne);

        $bookTwo = new Book();
        $bookTwo
            ->setTitle('Book two')
            ->setAuthor($authorTwo);
        $manager->persist($bookTwo);
        $this->addReference(self::BOOK_TWO, $bookTwo);

        $bookThree = new Book();
        $bookThree
            ->setTitle('Book two')
            ->setAuthor($authorThree);
        $manager->persist($bookThree);
        $this->addReference(self::BOOK_THREE, $bookThree);

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    #[\Override]
    public function getDependencies(): array
    {
        return [
            AuthorFixture::class
        ];
    }


}