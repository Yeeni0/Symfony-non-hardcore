<?php

namespace App\Entity;

use App\Repository\CoasterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoasterRepository::class)]
class Coaster
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $capacity = null;

    #[ORM\Column]
    private ?float $speed = null;

    #[ORM\Column(length: 255)]
    private ?string $return = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getSpeed(): ?float
    {
        return $this->speed;
    }

    public function setSpeed(float $speed): static
    {
        $this->speed = $speed;

        return $this;
    }

    public function getReturn(): ?string
    {
        return $this->return;
    }

    public function setReturn(string $return): static
    {
        $this->return = $return;

        return $this;
    }
}
