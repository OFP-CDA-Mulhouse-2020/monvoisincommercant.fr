<?php

namespace App\Entity;

use App\Repository\LocalizedRepository;
use Doctrine\ORM\Mapping as ORM;

## pulversheim : 47.8407752,7.2929497
##kruth : 47.9502167 6.944708
##wattwiller : 47.8417896 7.15898
##moosch: 47.8483332 7.0125271
/*
select
 *,
round(st_distance_sphere(coords, st_geomfromtext('Point(47.8483332 7.0125271)'))/1000,2) as distance
from localized
order by distance asc;
*/

/**
 * @ORM\Entity(repositoryClass=LocalizedRepository::class)
 */
class Localized
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
     * @ORM\Column(type="point")
     */
    private $coords;

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

    public function getCoords()
    {
        return $this->coords;
    }

    public function setCoords($coords): self
    {
        $this->coords = $coords;

        return $this;
    }
}
