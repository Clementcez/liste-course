<?php

namespace App\Controller\Client;

use App\Repository\Admin\ShoppingList\ShoppingListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    public function __construct(
            private ShoppingListRepository $shoppingListRepository
        )
    {
    }

    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        $shoppingLists = $this->shoppingListRepository->findAll();

        return $this->render('client/index.html.twig', [
            'shoppingLists' => $shoppingLists
        ]);
    }
}
