<?php

namespace App\Controller\Client;

use App\Entity\Admin\ShoppingList\ShoppingList;
use App\Entity\Admin\ShoppingList\ShoppingListItem;
use App\Form\Admin\ShoppingList\ShoppingListItemType;
use App\Form\Admin\ShoppingList\ShoppingListType;
use App\Repository\Admin\ShoppingList\ShoppingListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shopping-list')]
class ShoppingListController extends AbstractController
{
    public function __construct(
            private ShoppingListRepository $shoppingListRepository,
            private EntityManagerInterface $entityManager,
            private RequestStack $requestStack
        )
    {
    }

    #[Route('/new', name: 'app_shopping_list_new', methods: ['GET', 'POST'])]
    public function new(): Response
    {
        $shoppingList = new ShoppingList();
        $form = $this->createForm(ShoppingListType::class, $shoppingList);
        $form->handleRequest($this->requestStack->getMainRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($shoppingList);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('client/shopping_list/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}/shopping-list-item/add', name: 'app_shopping_list_shopping_list_item_add', methods: ['GET', 'POST'])]
    public function add(ShoppingList $shoppingList): Response
    {
        $shoppinListItem = new ShoppingListItem();
        $form = $this->createForm(ShoppingListItemType::class, $shoppinListItem);
        $form->handleRequest($this->requestStack->getMainRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            $shoppinListItem->setShoppingList($shoppingList);
            $this->entityManager->persist($shoppinListItem);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('client/shopping_list/edit.html.twig', [
            'shopping_list' => $shoppingList,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_shopping_list_edit', methods: ['GET', 'POST'])]
    public function edit(ShoppingList $shoppingList): Response
    {
        $form = $this->createForm(ShoppingListType::class, $shoppingList);
        $form->handleRequest($this->requestStack->getMainRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('app_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('client/shopping_list/edit.html.twig', [
            'shopping_list' => $shoppingList,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/remove', name: 'app_shopping_list_delete', methods: ['POST'])]
    public function delete(ShoppingList $shoppingList): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shoppingList->getId(), $this->requestStack->getMainRequest()->request->get('_token'))) {
            $this->entityManager->remove($shoppingList);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_index');
    }
}
