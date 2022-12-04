<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Reviews::class, orphanRemoval: true)]
    private Collection $reviews;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: OrderDetails::class, orphanRemoval: true)]
    private Collection $orderDetails;

    #[ORM\ManyToMany(targetEntity: Tags::class, mappedBy: 'products')]
    private Collection $tags;

    #[ORM\ManyToOne(targetEntity: Categories::class, inversedBy: 'products')]
    private Collection $categories;

    #[ORM\Column(nullable: true)]
    private ?bool $isNewArrival = false;

    #[ORM\Column(nullable: true)]
    private ?bool $isFeatured = false;

    #[ORM\Column(nullable: true)]
    private ?bool $isSpecialOffer = false;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $featuredImage = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isBestSeller = null;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->orderDetails = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Reviews>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Reviews $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setProduct($this);
        }

        return $this;
    }

    public function removeReview(Reviews $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getProduct() === $this) {
                $review->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OrderDetails>
     */
    public function getOrderDetails(): Collection
    {
        return $this->orderDetails;
    }

    public function addOrderDetail(OrderDetails $orderDetail): self
    {
        if (!$this->orderDetails->contains($orderDetail)) {
            $this->orderDetails->add($orderDetail);
            $orderDetail->setProduct($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetails $orderDetail): self
    {
        if ($this->orderDetails->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getProduct() === $this) {
                $orderDetail->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tags>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tags $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->addProduct($this);
        }

        return $this;
    }

    public function removeTag(Tags $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Categories>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categories $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addProduct($this);
        }

        return $this;
    }

    public function removeCategory(Categories $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeProduct($this);
        }

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsNewArrival(): ?bool
    {
        return $this->isNewArrival;
    }

    /**
     * @param bool|null $isNewArrival
     */
    public function setIsNewArrival(?bool $isNewArrival): void
    {
        $this->isNewArrival = $isNewArrival;
    }

    /**
     * @return bool|null
     */
    public function getIsFeatured(): ?bool
    {
        return $this->isFeatured;
    }

    /**
     * @param bool|null $isFeatured
     */
    public function setIsFeatured(?bool $isFeatured): void
    {
        $this->isFeatured = $isFeatured;
    }

    /**
     * @return bool|null
     */
    public function getIsSpecialOffer(): ?bool
    {
        return $this->isSpecialOffer;
    }

    /**
     * @param bool|null $isSpecialOffer
     */
    public function setIsSpecialOffer(?bool $isSpecialOffer): void
    {
        $this->isSpecialOffer = $isSpecialOffer;
    }

    public function getFeaturedImage(): ?string
    {
        return $this->featuredImage;
    }

    public function setFeaturedImage(?string $featuredImage): self
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    public function getIsBestSeller(): ?bool
    {
        return $this->isBestSeller;
    }

    public function setIsBestSeller(?bool $isBestSeller): self
    {
        $this->isBestSeller = $isBestSeller;

        return $this;
    }
}
