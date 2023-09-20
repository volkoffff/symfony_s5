<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route('/list-product', name: 'list_product')]
    public function listProducts(): Response
    {
        return $this->render('product/list_products.html.twig', [
            'title' => 'Liste des produits',
        ]);
    }

    #[Route('/view-product/{id}', name: 'view_product')]
    public function viewProduct(int $id): Response
    {

        return $this->render('product/product.html.twig', [
            'title' => 'Liste des produits',
            'id' => $id
        ]);
    }
}
