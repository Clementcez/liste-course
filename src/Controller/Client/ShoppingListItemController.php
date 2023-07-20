<?php

namespace App\Controller\Client;

use App\Entity\Admin\ShoppingList\ShoppingListItem;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shopping-list-item')]
class ShoppingListItemController extends AbstractController
{
    public function __construct(
            private EntityManagerInterface $entityManager,
            private RequestStack $requestStack
        )
    {
    }

    #[Route('/{id}/add', name: 'app_shopping_list_item_add', methods: ['POST'])]
    public function add(ShoppingListItem $shoppingListItem): Response
    {
        if ($this->isCsrfTokenValid('add'.$shoppingListItem->getId(), $this->requestStack->getMainRequest()->request->get('_token'))) {
            $shoppingListItem->setQuantity($shoppingListItem->getQuantity()+1);
            $this->entityManager->persist($shoppingListItem);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_index');
    }

    #[Route('/{id}/minus', name: 'app_shopping_list_item_minus', methods: ['POST'])]
    public function minus(ShoppingListItem $shoppingListItem): Response
    {
        if ($this->isCsrfTokenValid('minus'.$shoppingListItem->getId(), $this->requestStack->getMainRequest()->request->get('_token'))) {

            if ($shoppingListItem->getQuantity() === 1) {
                $this->entityManager->remove($shoppingListItem);
            }else{
                $shoppingListItem->setQuantity($shoppingListItem->getQuantity()-1);
                $this->entityManager->persist($shoppingListItem);
            }

            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_index');
    }

    #[Route('/{id}/remove', name: 'app_shopping_list_item_delete', methods: ['POST'])]
    public function delete(ShoppingListItem $shoppingListItem): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shoppingListItem->getId(), $this->requestStack->getMainRequest()->request->get('_token'))) {
            $this->entityManager->remove($shoppingListItem);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_index');
    }

    #[Route('/{id}/checked', name: 'app_shopping_list_item_checked', methods: ['GET'])]
    public function check(ShoppingListItem $shoppingListItem)
    {
        $shoppingListItem->setChecked(!$shoppingListItem->isChecked());
        $this->entityManager->persist($shoppingListItem);
        $this->entityManager->flush();

        return new JsonResponse('success', 200);
    }
}
