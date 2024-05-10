<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordEncorder)
    {
    }
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 40; $i++) {
            $user = new User();
            $user->setUsername("user$i");
            $user->setPassword($this->passwordEncorder->hashPassword($user, 'password'));
            $user->setEmail("email$i@gmail.com");
            $user->setFirstName("User$i");
            $user->setLastName("User$i");
            $user->setBiograohie("Bio$i");
            $user->setLastOnline(new \DateTime());
            $manager->persist($user);
            $this->addReference("user-" . $i, $user);
        }
        $manager->flush();
    }
}
