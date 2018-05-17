<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Method({"GET", "POST"})
     */
    public function connexionAction(SessionInterface $session)
    {

        if (!empty($_POST['username'])){


            $session->set('user', $_POST['username']);
            $user = $session->get('user');

            return $this->redirectToRoute('list', [
                'user' => $user
            ]);
        }

        return $this->render('connexion/connexion.html.twig');
    }

    /**
     * @Route("/logout")
     * @Method({"GET", "POST"})
     */
    public function logoutAction(SessionInterface $session)
    {
        $session->invalidate();

        return $this->render('connexion/connexion.html.twig');

    }
}


