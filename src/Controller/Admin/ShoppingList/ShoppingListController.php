<?php

namespace App\Controller\Admin\ShoppingList;

use App\Entity\Admin\ShoppingList\ShoppingList;
use App\Form\Admin\ShoppingList\ShoppingListType;
use App\Repository\Admin\ShoppingList\ShoppingListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/shopping/list/shopping/list')]
class ShoppingListController extends AbstractController
{
    #[Route('/', name: 'app_admin_shopping_list_shopping_list_index', methods: ['GET'])]
    public function index(ShoppingListRepository $shoppingListRepository): Response
    {
        return $this->render('admin/shopping_list/shopping_list/index.html.twig', [
            'shopping_lists' => $shoppingListRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_admin_shopping_list_shopping_list_show', methods: ['GET'])]
    public function show(ShoppingList $shoppingList): Response
    {
        return $this->render('admin/shopping_list/shopping_list/show.html.twig', [
            'shopping_list' => $shoppingList,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_shopping_list_shopping_list_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ShoppingList $shoppingList, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ShoppingListType::class, $shoppingList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_shopping_list_shopping_list_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/shopping_list/shopping_list/edit.html.twig', [
            'shopping_list' => $shoppingList,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_shopping_list_shopping_list_delete', methods: ['POST'])]
    public function delete(Request $request, ShoppingList $shoppingList, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shoppingList->getId(), $request->request->get('_token'))) {
            $entityManager->remove($shoppingList);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_shopping_list_shopping_list_index', [], Response::HTTP_SEE_OTHER);
    }
}
