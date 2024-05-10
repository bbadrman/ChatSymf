<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Conversation;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ConversationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $conversation = new Conversation();
            $conversation->setTitle('Conversation' . $i);
            /**
             * @var User $user
             */
            $user = $this->getReference('user-' . $i);
            $conversation->setCreatedBy($user);
            $conversation->addParticipant($user);
            $conversation->addParticipant($user);

            $manager->persist($conversation);
            $this->addReference('conversation-' . $i, $conversation);
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
