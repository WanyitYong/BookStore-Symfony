<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function load(ObjectManager $manager)
    {
        $User = $this->createUser('user', 'user');
        $Admin = $this->createUser('admin', 'admin', ['ROLE_ADMIN']);

        $manager->persist($User);
        $manager->persist($Admin);

        $manager->flush();
    }

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    { $this->passwordEncoder = $passwordEncoder; }

    private function createUser($username, $plainPassword, $roles = ['ROLE_USER']):User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setRoles($roles);

        $encodedPassword = $this->passwordEncoder->encodePassword($user, $plainPassword); $user->setPassword($encodedPassword);
        return $user;
    }
}
