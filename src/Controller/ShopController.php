<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\CartType;
use App\Entity\Product;
use App\Form\AddToCartType;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Service\Cart\CartService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShopController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(ProductRepository $productRepository, CartService $cartService): Response
    {
        return $this->render('shop/home.html.twig',[
            'products' => $productRepository->findAll(),
            'count' => $cartService->getCount(),
        ]);
        
    }

    /**
     * @Route("/product/{id}", name="product.detail")
     */
    public function detail(Product $product, CartService $cartService): Response
    {
        $form = $this->createForm(AddToCartType::class);
        
        return $this->render('shop/productDetails.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
            'count' => $cartService->getCount(),
        ]);
    }

    /**
     * @Route("/cart", name="cart")
     */
    public function cart(Request $request, CartService $cartService): Response
    {

        return $this->render('shop/cart.html.twig', [
            'items' => $cartService->getFullCart(),
            'total' => $cartService->getTotal(),
            'count' => $cartService->getCount(),
        ]);

    }

    /**
     * @Route("/cart/add/{id}", name="cart.add")
     */
    public function add($id, CartService $cartService): Response
    {

        $cartService->add($id);
        
        return $this->redirectToRoute('cart');
        
    }
    /**
     * @Route("/cart/remove/{id}", name="cart.remove")
     */
    public function remove($id, CartService $cartService): Response
    {
        
        $cartService->remove($id);

        return $this->redirectToRoute('cart');

    }

    /**
     * @Route("/checkout", name="checkout")
     */
    public function checkout(CartService $cartService)
    {
        return $this->render('shop/checkout.html.twig', [
            'items' => $cartService->getFullCart(),
            'total' => $cartService->getTotal(),
            'count' => $cartService->getCount(),
        ]);
    }

    
    /**
     * @Route("/home", name="confirmed")
     */
    public function confirmed(ProductRepository $productRepository, CartService $cartService): Response
    {
        return $this->render('shop/home.html.twig',[
            'products' => $productRepository->findAll(),
            'count' => $cartService->resetCount(),
        ]);   
    }
}
