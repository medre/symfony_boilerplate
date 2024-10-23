<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class AppController extends AbstractController
{
    public function __construct(private MailerInterface $mailer) {}

    #[Route('/', name: 'app_home')]
    public function index(#[CurrentUser] ?User $user): Response
    {
        return $this->render('app/index.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/about', name: 'page_about')]
    public function about(): Response
    {
        return $this->render('app/about.html.twig');
    }

    #[Route('/contact', name: 'page_contact')]
    public function contact(): Response
    {
        return $this->render('app/contact.html.twig');
    }
}
