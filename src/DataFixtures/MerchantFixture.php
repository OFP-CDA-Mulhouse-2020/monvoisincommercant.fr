<?php

namespace App\DataFixtures;

use App\Entity\Merchant;
use CrEOF\Spatial\PHP\Types\Geography\Point;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MerchantFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $merchant = new Merchant();
        $category = $this->getReference(MerchantCategoryFixture::CATEGORY_BOULANGERIE);
        $merchant
            ->setShopName("Les délices de Frida")
            ->setFirstname("Marielle")
            ->setName("Capon")
            ->setStreet("rue du pont")
            ->setStreetNumber(12)
            ->setDescription("Boulangerie Patisserie de grand qualité")
            ->setPhone("03.89.37.04.93")
            ->setCity("BITSCHWILLER LES THANN")
            ->setCodePostal("68620")
            ->setEmail("bonjour@lesdelicesdefrida.fr")
            ->setWebsite("https://www.lesdelicesdefrida.fr")
            ->setCategory($category)
            ->setCoords(new Point(47.8304406,7.0792377,4326));

        // $product = new Product();
        $manager->persist($merchant);

        $merchant = new Merchant();
        $category = $this->getReference(MerchantCategoryFixture::CATEGORY_RESTAURANT);

        $merchant
            ->setShopName("Restaurant Au Chasseur")
            ->setFirstname("Catherine")
            ->setName("Dick")
            ->setStreet("rue du chasseur")
            ->setStreetNumber(4)
            ->setDescription("Restaurant fermé à cause du confinement")
            ->setPhone("03.89.41.09.41")
            ->setCity("COLMAR")
            ->setCodePostal("68000")
            ->setEmail("au.chasseur@orange.fr")
            ->setWebsite("https://chasseur.restaurant")
            ->setCategory($category)
            ->setCoords(new Point(48.0771117,7.3591337,4326));

        // $product = new Product();
        $manager->persist($merchant);

        $manager->flush();
    }

    public static function getGroups(): array
    {
        // TODO: Implement getGroups() method.
    }

    public function getDependencies()
    {
        return [
            MerchantCategoryFixture::class
        ];
    }
}
