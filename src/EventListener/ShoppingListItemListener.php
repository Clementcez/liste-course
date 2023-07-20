<?php

namespace App\EventListener;

use App\Entity\Admin\ShoppingList\ShoppingListItem;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\EntityManagerInterface;

#[AsDoctrineListener('prePersist')]
class ShoppingListItemListener
{
    public function __construct(
            private EntityManagerInterface $entityManager
        )
    {
    }

    public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof ShoppingListItem) {
            return;
        }

        $shoppingListItem = $this->entityManager->getRepository(ShoppingListItem::class)->findOneBy([
            'shoppingList' => $entity->getShoppingList(),
            'product' => $entity->getProduct()
        ]);

        if ($shoppingListItem) {
            $entity->setQuantity($shoppingListItem->getQuantity() + $entity->getQuantity());

            $this->entityManager->remove($shoppingListItem);
        }
    }
}