<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use App\Classe\Mailjet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderValidateController extends AbstractController
{
    /**
     * @Route("/order/success", name="order_validate")
     */
    public function index(
        Cart $cart,
        EntityManagerInterface $manager,
        ?string $stripeSessionUrl
    ): Response {
        $order = $manager->getRepository(Order::class)->findOneByStripeSessionUrl($stripeSessionUrl);

        // Security : if order doesn't exist or if it's not the good user
        if (!$order /* || $order->getUser() != $this->getUser() */) {
            return $this->redirectToRoute('home');
        }

        // If the order has an "unpaid" status, place it in paid
        if ($order->getIsPaid()) {
            // Empty the "cart" session
            $cart->remove();
            // Modify the status isPaid of the order with 1
            // $order->setIsPaid(1);
            $manager->flush();
        }
        // Order confirmation by email
        // $mail = new Mailjet();
        // $content = "Hello " . $order->getUser()->getFirstname() . "<br>" . "Thank you for your order on the Fashion";
        // $mail->send($order->getUser()->getEmail(), $order->getUser()->getFirstname(), 'Your Fashion order has been confirmed.', $content);

        return $this->render('order_validate/index.html.twig', [
            'order' => $order
        ]);
    }


    /**
     * @Route("/order/cancel", name="order_cancel")
     */
    public function cancel(
        EntityManagerInterface $manager,
        ?string $stripeSessionUrl
    ): Response {
        $order = $manager->getRepository(Order::class)->findOneByStripeSessionUrl($stripeSessionUrl);

        // Security : redirection if it's not the good user
        if (!$order /* || $order->getUser() != $this->getUser() */) {
            return $this->redirectToRoute('home');
        }

        // Send email to user to indicate payment failure

        return $this->render('order_validate/cancel.html.twig', [
            'order' => $order
        ]);
    }
}
