<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\Length(
        min: 5,
        max: 50,
        minMessage: 'Your {{ label }} cannot be smaller than {{ limit }} characters',
        maxMessage: 'Your {{ label }} cannot be longer than {{ limit }} characters',
    )]
    #[Assert\NotBlank]
    #[Assert\Type(
        type: 'string',
        message: 'Your {{ label }} is not a valid {{ type }}',
    )]
    #[ORM\Column(length: 255)]
    private string $name;

    #[Assert\NotBlank]
    #[Assert\Length(
        min: 10,
        max: 250,
        minMessage: 'Your {{ label }} cannot be smaller than {{ limit }} characters',
        maxMessage: 'Your {{ label }} cannot be longer than {{ limit }} characters',
    )]
    #[Assert\Type(
        type: Types::TEXT,
        message: 'Your {{ label }} is not a valid {{ type }}',
    )]
    #[ORM\Column(type: Types::TEXT)]
    private string $description;

    #[Assert\NotBlank]
    #[Assert\Positive]
    #[Assert\Type(
        type: 'integer',
        message: 'The value {{ value }} is not a valid {{ type }}.',
    )]
    #[ORM\Column]
    private float $price;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }
}
