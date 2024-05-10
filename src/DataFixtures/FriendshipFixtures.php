<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Friendship;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class FriendshipFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $friend = new Friendship();
            /**
             * @var User $user
             */
            $user = $this->getReference('user-' . $i);
            $friend->setRequester($user);
            $friend->setRecevier($user);
            $manager->persist($friend);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
