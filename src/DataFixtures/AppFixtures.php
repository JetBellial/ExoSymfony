<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\User;
use App\Entity\Commentary;
use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;




class AppFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher){}


    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $tabUser = [];
        $tabArticle = [];
        $tabCategory = [];

        for ($i=0; $i < 25; $i++) { 
            $user = new User();
            $user->setFirstname($faker->firstName('male'|'female'))
                ->setLastname($faker->lastName())
                ->setEmail($user->getFirstname().$user->getLastname().'@'.$faker->freeEmailDomain())
                ->setPassword($this->hasher->hashPassword($user,'12345'))
                ->setAvatar($faker->imageUrl(300,300,'people'))
                ->setRoles(['ROLE_USER']);

            $tabUser[] = $user;
            $manager->persist($user);
        }
        
        for ($i=0; $i < 30; $i++) { 
            $category = new Category();
            $category->setLibele($faker->words(1,true));

            $tabCategory[] = $category;
            $manager->persist($category);
        }

        for ($i=0; $i < 100; $i++) { 
            
            $article = new Article();
            $article->setTitle($faker->words(6,true))
                    ->setContent($faker->paragraph(5,true))
                    ->setCreateAt(\DateTimeImmutable::createFromMutable($faker->datetime()))
                    ->setUser($tabUser[array_rand($tabUser)])
                    ->addCategory($tabCategory[array_rand($tabCategory)]);

            $tabArticle[] = $article;
            $manager->persist($article);
        }

        for ($i=0; $i < 10; $i++) { 
            
            $comment = new Commentary();
            $comment->setContent($faker->paragraph(2,true))
                    ->setCreateAt(\DateTimeImmutable::createFromMutable($faker->datetime()))
                    ->setArticle($tabArticle[array_rand($tabArticle)])
                    ->setUser($tabUser[array_rand($tabUser)]);

            $manager->persist($comment);
        }
        
        $manager->flush();
    }
}

