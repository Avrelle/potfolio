<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
            $user-> setNom('Delahaye');
            $user->setPrenom('Anton');
            $user->setEmail('anto.delahaye@gmail.com');
            $user->setUsername('Avrelle');
            $user->setAge('21');
            $password = $this->hasher->hashPassword($user, 'Taxjad55');
            $user->setPassword($password);



        $manager->persist($user);


        $manager->flush();
    }
}
