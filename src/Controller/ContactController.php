<?php

namespace App\Controller;

use App\Classe\Mailjet;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contactus", name="contact")
     */
    public function index(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->addFlash('notice', 'thank you for contacting us, our team will answer you as soon as possible');
            $formData = $form->getData();

            $content = "Welcome, <br/>You have a new contact request from" . $formData['nom'] . ' ' . $formData['prenom'] . "<br>" . "<br>" .
                "Customer email : " . $formData['email'] . "<br/>" . "<br/>" . $formData['content'];
            $mail = new Mailjet();
            $mail->send('gblhiep@gmail.com', 'Fashion', 'You have received a new request for d\'information', $content);
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
