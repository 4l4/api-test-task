<?php

namespace App\DataFixtures;

use App\Entity\Group;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GroupFixtures extends Fixture
{
    public const EXAMPLE_GROUP_REFERENCE = 'example-group';

    public function load(ObjectManager $manager)
    {
        $group = new Group();
        $group->setName('TestGroup');

        $manager->persist($group);
        $manager->flush();

        $this->addReference(self::EXAMPLE_GROUP_REFERENCE, $group);
    }
}
