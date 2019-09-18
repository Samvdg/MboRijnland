<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use App\Controller\ProductController;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(ProductRepository $productRepository)
    {
        $product = [];
        $cart = $productRepository->fillDetails($product);
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'items' => $cart["items"],
            'actualPrice' => $cart["actualPrice"],
        ]);
    }
}
