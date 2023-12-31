<?php

namespace App\Entity\Admin\ShoppingList;

use App\Entity\Admin\Product;
use App\Repository\Admin\ShoppingList\ShoppingListItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ShoppingListItemRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ShoppingListItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\Column]
    #[Assert\Positive]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'shoppingListItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ShoppingList $shoppingList = null;

    #[ORM\Column]
    private ?bool $checked = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->product . ' X' . $this->quantity;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getShoppingList(): ?ShoppingList
    {
        return $this->shoppingList;
    }

    public function setShoppingList(?ShoppingList $shoppingList): static
    {
        $this->shoppingList = $shoppingList;

        return $this;
    }

    public function isChecked(): ?bool
    {
        return $this->checked;
    }

    public function setChecked(bool $checked): static
    {
        $this->checked = $checked;

        return $this;
    }
}
