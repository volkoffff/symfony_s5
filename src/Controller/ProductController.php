<?php

namespace App\Controller;

use App\Service\SlugService;
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

    #[Route('/product/slug', name: 'app_slug_product')]
    public function slugProducts(SlugService $slugify): Response
    {

        $texte = $slugify->generateSlug('ceci est une phrase en français');


        return $this->render('product/slugIndex.html.twig', [
            'controller_name' => 'ProductController',
            'slug' => $texte
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
