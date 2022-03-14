<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart_index")
     */
    public function index(SessionInterface $session, ProductRepository $productRepository)
    {
        $cart = $session->get('cart', []);
        $cartProducts = [];

        foreach ($cart as $id => $quantity) {
            $cartProducts[] = [
                'product' => $productRepository->find($id),
                'quantity' => $quantity
            ];
        }
        $total = 0;
        foreach ($cartProducts as $item) {
            $totalItem = $item['product']->getPriceHT() * $item['quantity'];
            $total += $totalItem;
        };
        $session->set('cartProducts', $cartProducts);
        return $this->render('cart/index.html.twig', ['items' => $cartProducts, 'total' => $total]);
    }

    /**
     * @Route("/cart/add/{id}", name="cart_add")
     */
    public function add($id, SessionInterface $session)
    {
        $cart = $session->get('cart', []);


        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }
        $session->set('cart', $cart);
        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/cart/remove/{id}", name="cart_remove")
     */
    public function remove($id, SessionInterface $session)
    {
        $cart = $session->get('cart', []);
        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }
        $session->set('cart', $cart);

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/cart/removeAll"), name="cart_remove_all")
     */
    public function removeAll(SessionInterface $session)
    {
        $session->set('cart', []);
        return $this->redirectToRoute("cart_index");
    }
}