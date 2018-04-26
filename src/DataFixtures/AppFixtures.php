<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('vardas');
        $password = $this->passwordEncoder->encodePassword($user, 'admin');
        $user->setPassword($password);
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setUsername('Jonas');
        $password = $this->passwordEncoder->encodePassword($user, 'admin');
        $user->setPassword($password);
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $manager->flush();
    }
}
