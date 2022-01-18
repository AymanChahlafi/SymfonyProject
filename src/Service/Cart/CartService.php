<?php
namespace App\Service\Cart;

use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{

    protected $session;

    protected $productRepository;


    public function __construct(RequestStack $requestStack, ProductRepository $productRepository) {
        $this->session = $requestStack->getSession();
        $this->productRepository = $productRepository;
        
    }    

    public function add(int $id) {

        $cart= $this->session->get('cart',[]);

        
        if (!array_key_exists($id,$cart)) {
            $cart[$id]=1;
        } else {
            $cart[$id]++;
        }
        
        $this->session->set('cart', $cart);
    }

    public function remove(int $id) {

        $cart=$this->session->get('cart',[]);

        
        if (array_key_exists($id,$cart)) {
            unset($cart[$id]);
        }
        
        $this->session->set('cart', $cart);
    }

    public function getFullCart(): array 
    {
        $cart= $this->session->get('cart',[]);
        $cartItems= [];

        foreach ($cart as $id => $quantity) {
            $cartItems[]=[
                'product' => $this->productRepository->find($id),
                'quantity' => $quantity,
            ];
        }

        return $cartItems;
    }


    public function getTotal(): float {
        $total=0;

        foreach ($this->getFullCart() as $item) {
            $total+=$item['product']->getPrice() * $item['quantity'];
        }
        return $total;
    }
    public function getCount():int {
        $count=0;

        foreach ($this->getFullCart() as $item) {
            if ($item['quantity']==1) {
                $count++;
                
            } elseif ($item['quantity']>1) {
                $count+=$item['quantity'];

            }
            
        }
        return $count;
    }
    public function resetCount():int {
        $this->session->set('cart', []);
        return 0;
    }
}
