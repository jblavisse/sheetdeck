<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Bundle\MakerBundle\Maker\MakeMessage;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ApiResource]
#[GetCollection(
    name: 'get_categories',
    uriTemplate: '/categories',
    normalizationContext: ['groups' => ['category:get_collection']],
)]
#[Get(
    name: 'get_category',
    uriTemplate: '/categories/{id}',
    normalizationContext: ['groups' => ['category:get']],
)]
#[UniqueEntity(fields: ['name'], message: 'Category with this name already exists.')]
#[Post(
    name: 'create_category',
    uriTemplate: '/categories',
    normalizationContext: ['groups' => ['category:create']],
)]
#[Put(
    name: 'update_category',
    uriTemplate: '/categories/{id}',
    normalizationContext: ['groups' => ['category:update']],
)]
#[Delete(
    name: 'delete_category',
    uriTemplate: '/categories/{id}',
    denormalizationContext: ['groups' => ['category:delete']],
)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['cheatsheet:get_collection', 'cheatsheet:get', 'category:get'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['cheatsheet:get_collection', 'cheatsheet:get', 'category:get_collection', 'category:get', 'category:create', 'category:update', 'category:delete'])]
    private ?string $name = null;

    /**
     * @var Collection<int, Cheatsheet>
     */
    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Cheatsheet::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[Groups(['category:get'])]
    private Collection $category;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Cheatsheet>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Cheatsheet $category): static
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
            $category->setCategory($this);
        }

        return $this;
    }

    public function removeCategory(Cheatsheet $category): static
    {
        if ($this->category->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getCategory() === $this) {
                $category->setCategory(null);
            }
        }

        return $this;
    }
}
