<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Factory\Admin\CategoryFactory;
use App\Factory\Admin\ProductFactory;
use App\Factory\Admin\ShoppingList\ShoppingListFactory;
use App\Factory\Admin\ShoppingList\ShoppingListItemFactory;
use App\Factory\Admin\StoreFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
            private UserPasswordHasherInterface $hasher,
            private EntityManagerInterface $entityManager
        )
    {
    }
    
    public function load(ObjectManager $manager): void
    {
        $this->loadUser();
        CategoryFactory::createMany(5);
        StoreFactory::createMany(5);
        ProductFactory::createMany(15);
        ShoppingListFactory::createMany(5);
        ShoppingListItemFactory::createMany(50);

        $this->entityManager->flush();
    }

    private function loadUser(){
        $user = new User();
        $user->setEmail('test@test.fr');
        $user->setRoles(["ROLE_ADMIN"]);

        $password = $this->hasher->hashPassword($user, 'toto1234');
        $user->setPassword($password);

        $this->entityManager->persist($user);
    }
}
