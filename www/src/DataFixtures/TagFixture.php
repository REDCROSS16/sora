<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TagFixture extends Fixture implements DependentFixtureInterface
{
    public const string TAG_ONE = 'tag_one';
    public const string TAG_TWO = 'tag_two';
    public const string TAG_THREE = 'tag_three';

    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $authorOne = $this->getReference(AuthorFixture::AUTHOR_ONE);
        $authorTwo = $this->getReference(AuthorFixture::AUTHOR_TWO);
        $authorThree = $this->getReference(AuthorFixture::AUTHOR_THREE);

        $tagOne = new Tag();
        $tagOne
            ->setTitle('Tag One')
            ->addAuthor($authorOne)
            ->addAuthor($authorTwo);
        $manager->persist($tagOne);
        $this->addReference(self::TAG_ONE, $tagOne);

        $tagTwo = new Tag();
        $tagTwo
            ->setTitle('Tag Two')
            ->addAuthor($authorOne)
            ->addAuthor($authorThree);
        $manager->persist($tagTwo);
        $this->addReference(self::TAG_TWO, $tagTwo);

        $tagThree = new Tag();
        $tagThree
            ->setTitle('Tag Three')
            ->addAuthor($authorOne)
            ->addAuthor($authorTwo)
            ->addAuthor($authorThree);
        $manager->persist($tagThree);
        $this->addReference(self::TAG_THREE, $tagThree);

        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            AuthorFixture::class
        ];
    }
}