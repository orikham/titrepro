<?php

namespace App\Controller;

use App\Entity\Messagerie;
use App\Repository\InfosContactRepository;
use App\Repository\MessagerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    private $infosContactRepository;
    private $messagerieRepository;
    private $entityManager;
    private $mailer;

    public function __construct(
        InfosContactRepository $infosContactRepository,
        MessagerieRepository $messagerieRepository,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
    ) {
        $this->infosContactRepository = $infosContactRepository;
        $this->messagerieRepository = $messagerieRepository;
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
    }

    #[Route('/contact/', name: 'app_contact', methods: ['GET', 'POST'])]
    public function infoContact(Request $request): Response
    {
        $infosContact = $this->infosContactRepository->findAll();

        // Créez une instance de l'entité Messagerie
        $messagerie = new Messagerie();

        // Créez le formulaire et associez-le à l'entité Messagerie
        $form = $this->createFormBuilder($messagerie)
            ->add('nom')
            ->add('prenom')
            ->add('phone')
            ->add('mail')
            ->add('object')
            ->add('message')
            ->getForm();

        // Gérez la soumission du formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérez les données du formulaire
            $messagerie = $form->getData();

            // Sauvegardez les données dans la base de données
            $this->entityManager->persist($messagerie);
            $this->entityManager->flush();

            // Envoyez l'e-mail
            $this->sendEmail($messagerie);

            // Ajoutez un message flash pour indiquer que le formulaire a été soumis avec succès
            $this->addFlash('success', 'Formulaire soumis avec succès.');

            // Redirigez si nécessaire
            return $this->redirectToRoute('app_contact');
        }

        // Affichez le formulaire dans le template
        return $this->render('contact/contact.html.twig', [
            'infosContact' => $infosContact,
            'form' => $form->createView(),
        ]);
    }

    private function sendEmail(Messagerie $messagerie): void
    {
        $email = (new Email())
            ->from($messagerie->getMail())
            //->to('cault.paysages@gmail.com')  // Adresse e-mail de destination
            ->to('orikham@hotmail.fr')
            ->subject($messagerie->getObject())
            ->text($messagerie->getMessage());

        $this->mailer->send($email);
    }
}
