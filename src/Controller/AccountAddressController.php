<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Address;
use App\Form\AddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountAddressController extends AbstractController
{
    /**
     * @Route("/account/address", name="account_address")
     */
    public function index(): Response
    {
        return $this->render('account/address.html.twig');
    }

    /**
     * @Route("/account/add-address", name="account_address_add")
     */
    public function add(
        Request $request,
        EntityManagerInterface $manager,
        Cart $cart
    ): Response {
        $address = new Address;
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $address->setUser($this->getUser());

            $manager->persist($address);
            $manager->flush();

            if ($cart->get()) {                     // If I have products in my cart
                return $this->redirectToRoute('order');
            } else {
                return $this->redirectToRoute('account_address');
            }
        }

        return $this->render('account/address_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/account/edit-address/{id}", name="account_address_edit")
     */
    public function edit(
        Request $request,
        EntityManagerInterface $manager,
        int $id
    ): Response {
        $address = $manager->getRepository(Address::class)->find($id);

        if (!$address || $address->getUser() != $this->getUser()) {
            return $this->redirectToRoute('account_address');
        }

        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->flush();
            return $this->redirectToRoute('account_address');
        }

        return $this->render('account/address_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/account/delete-address/{id}", name="account_address_delete")
     */
    public function delete(
        EntityManagerInterface $manager,
        int $id
    ): Response {
        $address = $manager->getRepository(Address::class)->find($id);

        if ($address && $address->getUser() == $this->getUser()) {
            $manager->remove($address);
            $manager->flush();
        }

        return $this->redirectToRoute('account_address');
    }
}
