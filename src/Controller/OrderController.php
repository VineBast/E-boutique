<?php

namespace App\Controller;

use App\Entity\CommandLine;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="app_order")
     */
    public function order(SessionInterface $session, EntityManagerInterface $entityManager)
    {
        $order = new Order();
        $produit = $session->get('product');
        $order->setEmail($this->getUser());
        $order->setValid('yes');
        $entityManager->persist($order);
        $entityManager->flush();
        $order->setOrderNumber($order->getId());
        $entityManager->persist($order);
        $entityManager->flush();
        $cartProducts = $session->get('cartProducts', []);

        foreach ($cartProducts as $id => $value) {
            $commandLine = new CommandLine();
            $commandLine->setOrderNumber($order);
            $commandLine->setQuantity($value['quantity']);
            $entityManager->persist($commandLine);
            $entityManager->flush();
        }
        return $this->redirectToRoute("app_cart_removeall");
    }
}