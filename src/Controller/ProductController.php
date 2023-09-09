<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Category;
use App\Entity\Product;

#[Route('/api', name: 'api_')]
class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $category = new Category();
        $category->setName('Computer Peripherals');

        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomic and stylish!');

        // повʼязує цей продукт з категорією
        $product->setCategory($category);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($category);
        $entityManager->persist($product);
        $entityManager->flush();

        return new Response(
            'Saved new product with id: '.$product->getId()
            .' and new category with id: '.$category->getId()
        );
    }

    #[Route('/show', name: 'app_show')]
    public function show(ManagerRegistry $doctrine): Response
    {
        $product = $doctrine->getRepository(Product::class)->find(1);

        $categoryName = $product->getCategory()->getName();
        return $this->json(['lox' => 'test']);
//        return new Response(
//            'Product name: '.$categoryName
//        );
    }
}
