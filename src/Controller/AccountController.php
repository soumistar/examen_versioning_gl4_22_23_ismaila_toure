<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/compte', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig');
    }

    #[Route('/compte/changer-mot-de-passe', name: 'app_account_password')]
    public function password(): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);
        return $this->render('account/password.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
