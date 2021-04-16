<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public $faker;
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->faker = Factory::create();
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $this->loadAdmin($manager);
        $manager->flush();
    }

    public function loadAdmin(ObjectManager $manager){

      

            $myUser = new User();
            $myUser->setEmail("admin@test.com");
            $myUser->setRoles([User::ROLE_ADMIN]);
            $myUser->setPassword($this->passwordEncoder->encodePassword(
                $myUser,
                'admin'
            ));

            $manager->persist($myUser);

            $manager->flush();
    }
}  
