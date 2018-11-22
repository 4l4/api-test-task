<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('user@example.com');
        $user->setLastName('Example');
        $user->setFirstName('User');
        $user->setGroup($this->getReference(GroupFixtures::EXAMPLE_GROUP_REFERENCE));

        $manager->persist($user);
        $manager->flush();
    }
}
