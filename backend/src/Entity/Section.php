<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SectionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SectionRepository::class)]
#[ApiResource]
class Section
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['cheatsheet:get_collection', 'cheatsheet:get', 'cheatsheet:create', 'cheatsheet:update', 'section:get', 'section:create', 'section:update'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['cheatsheet:get', 'cheatsheet:create', 'cheatsheet:update', 'section:get', 'section:create', 'section:update'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['cheatsheet:get', 'cheatsheet:create', 'cheatsheet:update', 'section:get', 'section:create', 'section:update'])]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'sections')]
    private ?Cheatsheet $cheatsheet = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getCheatsheet(): ?Cheatsheet
    {
        return $this->cheatsheet;
    }

    public function setCheatsheet(?Cheatsheet $cheatsheet): static
    {
        $this->cheatsheet = $cheatsheet;

        return $this;
    }
}
