<?php

namespace App\DataFixtures;

use App\Entity\Recette;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class RecettesFixtures extends Fixture
{

    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($recp = 1; $recp <= 10; $recp++)
        {
            
            $rcp = new Recette();
            $rcp->setId($faker->numberBetween(1, 2000));
            $rcp->setTitle($faker->text(5));
            $rcp->setSlug($this->slugger->slug($rcp->getTitle())->lower());
            $rcp->setContent($faker->text(200));
            $rcp->setImg($faker->text(20));
            $rcp->setCreatedAt();

            $manager->persist($rcp);
        }

        $manager->flush();
    }
}
