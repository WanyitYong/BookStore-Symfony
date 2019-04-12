<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Entity\Book;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function load(ObjectManager $manager)
    {
        $User = $this->createUser('user', 'user');
        $User2 = $this->createUser('qw', 'qw');
        $User3 = $this->createUser('as', 'as');
        $Admin = $this->createUser('admin', 'admin', ['ROLE_ADMIN']);

        $manager->persist($User);
        $manager->persist($User2);
        $manager->persist($User3);
        $manager->persist($Admin);

        $book1 = $this->createBook("T1", "A1", $User, 2.55, "description", "/images/bookCover01.png");
        $book2 = $this->createBook("T2", "A2", $User, 1.99, "description", "/images/bookCover01.png");

        $manager->persist($book1);
        $manager->persist($book2);

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

    private function createBook($title, $author,User $seller, $price, $description, $image):Book
    {
        $book = new Book();
        $book->setTitle($title);
        $book->setAuthor($author);
        $book->setSeller($seller);
        $book->setPrice($price);
        $book->setDescription($description);
        $book->setImage($image);

        return $book;
    }
}
