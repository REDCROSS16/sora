<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Override;

final class AuthorFixture extends Fixture
{
    public const string AUTHOR_ONE = 'author_one';
    public const string AUTHOR_TWO = 'author_two';
    public const string AUTHOR_THREE = 'author_three';

    #[Override]
    public function load(ObjectManager $manager): void
    {
        $authorOne = new Author();
        $authorOne
            ->setName('Author One');
        $manager->persist($authorOne);
        $this->addReference(self::AUTHOR_ONE, $authorOne);

        $authorTwo = new Author();
        $authorTwo
            ->setName('Author Two');
        $manager->persist($authorTwo);
        $this->addReference(self::AUTHOR_TWO, $authorTwo);

        $authorThree = new Author();
        $authorThree
            ->setName('Author Three');
        $manager->persist($authorThree);
        $this->addReference(self::AUTHOR_THREE, $authorThree);

        $manager->flush();
    }
}