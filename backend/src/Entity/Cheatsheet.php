<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\CheatsheetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CheatsheetRepository::class)]
#[ApiResource]
#[GetCollection(
    name: 'get_cheatsheets',
    uriTemplate: '/cheatsheets',
    normalizationContext: ['groups' => ['cheatsheet:get_collection']],
)]
#[Get(
    name: 'get_cheatsheet',
    uriTemplate: '/cheatsheets/{id}',
    normalizationContext: ['groups' => ['cheatsheet:get']],
)]
#[Post(
    name: 'create_cheatsheet',
    uriTemplate: '/cheatsheets',
    normalizationContext: ['groups' => ['cheatsheet:create']],
    denormalizationContext: ['groups' => ['cheatsheet:create']],
)]
#[Put(
    name: 'update_cheatsheet',
    uriTemplate: '/cheatsheets/{id}',
    normalizationContext: ['groups' => ['cheatsheet:update']],
    denormalizationContext: ['groups' => ['cheatsheet:update']],
)]
#[Delete(
    name: 'delete_cheatsheet',
    uriTemplate: '/cheatsheets/{id}',
    denormalizationContext: ['groups' => ['cheatsheet:delete']],
)]
class Cheatsheet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['cheatsheet:get_collection', 'cheatsheet:get'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 100,
        minMessage: 'This field must have at least {{ limit }} characters.',
        maxMessage: 'This field cannot have more than {{ limit }} characters.',
    )]
    #[Groups(['cheatsheet:get_collection', 'cheatsheet:get', 'cheatsheet:create', 'cheatsheet:update'])]
    private ?string $title = null;

    /**
     * @var Collection<int, Section>
     */
    #[ORM\OneToMany(targetEntity: Section::class, mappedBy: 'cheatsheet', cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[Groups(['cheatsheet:get', 'cheatsheet:create', 'cheatsheet:update'])]
    private Collection $sections;

    #[ORM\ManyToOne(inversedBy: 'category')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['cheatsheet:get_collection', 'cheatsheet:get', 'cheatsheet:create', 'cheatsheet:update'])]
    private ?Category $category = null;

    public function __construct()
    {
        $this->sections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, Section>
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function addSection(Section $section): static
    {
        if (!$this->sections->contains($section)) {
            $this->sections->add($section);
            $section->setCheatsheet($this);
        }

        return $this;
    }

    public function removeSection(Section $section): static
    {
        if ($this->sections->removeElement($section)) {
            // set the owning side to null (unless already changed)
            if ($section->getCheatsheet() === $this) {
                $section->setCheatsheet(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
