<?php

namespace App\Controller\Admin\ShoppingList;

use App\Entity\Admin\ShoppingList\ShoppingListItem;
use App\Form\Admin\ShoppingList\ShoppingListItemType;
use App\Repository\Admin\ShoppingList\ShoppingListItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/shopping/list/shopping/list/item')]
class ShoppingListItemController extends AbstractController
{
    #[Route('/', name: 'app_admin_shopping_list_shopping_list_item_index', methods: ['GET'])]
    public function index(ShoppingListItemRepository $shoppingListItemRepository): Response
    {
        return $this->render('admin/shopping_list/shopping_list_item/index.html.twig', [
            'shopping_list_items' => $shoppingListItemRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_shopping_list_shopping_list_item_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $shoppingListItem = new ShoppingListItem();
        $form = $this->createForm(ShoppingListItemType::class, $shoppingListItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($shoppingListItem);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_shopping_list_shopping_list_item_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/shopping_list/shopping_list_item/new.html.twig', [
            'shopping_list_item' => $shoppingListItem,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_shopping_list_shopping_list_item_show', methods: ['GET'])]
    public function show(ShoppingListItem $shoppingListItem): Response
    {
        return $this->render('admin/shopping_list/shopping_list_item/show.html.twig', [
            'shopping_list_item' => $shoppingListItem,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_shopping_list_shopping_list_item_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ShoppingListItem $shoppingListItem, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ShoppingListItemType::class, $shoppingListItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_shopping_list_shopping_list_item_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/shopping_list/shopping_list_item/edit.html.twig', [
            'shopping_list_item' => $shoppingListItem,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_shopping_list_shopping_list_item_delete', methods: ['POST'])]
    public function delete(Request $request, ShoppingListItem $shoppingListItem, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shoppingListItem->getId(), $request->request->get('_token'))) {
            $entityManager->remove($shoppingListItem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_shopping_list_shopping_list_item_index', [], Response::HTTP_SEE_OTHER);
    }
}
