<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TagFixture extends Fixture
{
    public const string TAG_REFERENCE_PREFIX = 'tag_';

    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 3; $i++) {
            $tag = new Tag();
            $tag->setTitle("Tag $i");
            $manager->persist($tag);

            // Сохраняем ссылку на тег для других фикстур
            $this->addReference(self::TAG_REFERENCE_PREFIX . $i, $tag);
        }

        $manager->flush();
    }
}