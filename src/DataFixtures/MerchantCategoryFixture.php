<?php

namespace App\DataFixtures;

use App\Entity\MerchantCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MerchantCategoryFixture extends Fixture
{
    public const CATEGORY_BOULANGERIE = 'boulangerie';
    public const CATEGORY_RESTAURANT = 'restaurant';

    public function load(ObjectManager $manager)
    {
        // $product = new Product();

        $category = new MerchantCategory();
        $category->setLabel("boulangerie")
            ->setColor("#ff00ff");


        $manager->persist($category);
        $manager->flush();
        $this->addReference(self::CATEGORY_BOULANGERIE, $category);

        ////------------------------------------

        $category = new MerchantCategory();
        $category->setLabel("restaurant")
            ->setColor("#00ff00");


        $manager->persist($category);
        $manager->flush();
        $this->addReference(self::CATEGORY_RESTAURANT, $category);

    }
}
