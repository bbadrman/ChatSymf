<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Message;
use App\Entity\Conversation;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MessageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $message = new Message();
            /**
             * @var User $user
             */
            $user = $this->getReference('user-' . $i);
            /**
             * @var Conversation $conversation
             */
            $conversation = $this->getReference('conversation-' . $i);

            $message->setSentBy($user);
            $message->setConversation($conversation);
            $message->setSentAt(new \DateTime());
            $message->setRead(true);
            $message->setContent('Hello user' . ($i + 5) . ', this is user' . $i);

            $manager->persist($message);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            ConversationFixtures::class,
        ];
    }
}
