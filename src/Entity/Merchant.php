<?php

namespace App\Entity;

use App\Repository\CommercantRepository;

use CrEOF\Spatial\PHP\Types\Geography\Point;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

use function floatval;
use function json_encode;

/**
 * @ORM\Entity(repositoryClass=CommercantRepository::class)
 */
class Merchant implements JsonSerializable
{

    public static function fromJson(string $json){

    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $shopName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $streetNumber;

    /**
     * @ORM\Column(type="string")
     */
    private $code_postal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="integer")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @var Point
     * @ORM\Column(type="point")
     */
    private $coords;

    /**
     * @ORM\ManyToOne(targetEntity=MerchantCategory::class, inversedBy="merchants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=12, nullable=true)
     */
    private $longitude;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=12, nullable=true)
     */
    private $latitude;

    /**
     * @param mixed $id
     * @return Merchant
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param mixed $name
     * @return Merchant
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $firstname
     * @return Merchant
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @param mixed $shopName
     * @return Merchant
     */
    public function setShopName($shopName)
    {
        $this->shopName = $shopName;
        return $this;
    }

    /**
     * @param mixed $street
     * @return Merchant
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @param mixed $streetNumber
     * @return Merchant
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;
        return $this;
    }

    /**
     * @param mixed $code_postal
     * @return Merchant
     */
    public function setCodePostal($code_postal)
    {
        $this->code_postal = $code_postal;
        return $this;
    }

    /**
     * @param mixed $city
     * @return Merchant
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param mixed $phone
     * @return Merchant
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param mixed $email
     * @return Merchant
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param mixed $website
     * @return Merchant
     */
    public function setWebsite($website)
    {
        $this->website = $website;
        return $this;
    }

    /**
     * @param mixed $description
     * @return Merchant
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param mixed $coords
     * @return Merchant
     */
    public function setCoords($coords)
    {
        $this->coords = $coords;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getShopName()
    {
        return $this->shopName;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return mixed
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->code_postal;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getCoords()
    {
        return $this->coords;
    }

    public function getCategory(): ?MerchantCategory
    {
        return $this->category;
    }

    public function setCategory(?MerchantCategory $category): self
    {
        $this->category = $category;

        return $this;
    }


    public function jsonSerialize()
    {

        //dd($this->getCoords());

        return [
            'id' => $this->getId(),
            'name' => $this->getShopName()." : ".$this->getFirstname()." ".$this->getName(),
            'position' => [$this->getLatitude(), $this->getLongitude()],
            'category' => $this->getCategory(),
            'description' => $this->getDescription(),
            'website' => $this->getWebsite(),
            'phone' => $this->getPhone(),
            'email' => $this->getEmail()
        ];


    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }
}
