<?php

namespace App\Entity;

use App\Repository\MerchantCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MerchantCategoryRepository::class)
 */
class MerchantCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity=Merchant::class, mappedBy="category_id")
     */
    private $merchants;

    public function __construct()
    {
        $this->merchants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection|Merchant[]
     */
    public function getMerchants(): Collection
    {
        return $this->merchants;
    }

    public function addMerchant(Merchant $merchant): self
    {
        if (!$this->merchants->contains($merchant)) {
            $this->merchants[] = $merchant;
            $merchant->setCategoryId($this);
        }

        return $this;
    }

    public function removeMerchant(Merchant $merchant): self
    {
        if ($this->merchants->removeElement($merchant)) {
            // set the owning side to null (unless already changed)
            if ($merchant->getCategoryId() === $this) {
                $merchant->setCategoryId(null);
            }
        }

        return $this;
    }
}
