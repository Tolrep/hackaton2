<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class ConnexionController extends Controller
{
    /**
     * @Route("/connexion")
     */
    public function connexionAction()
    {
        if (!empty($_POST)){

            $sessionUser = new Session();
            $sessionUser->start();

            $sessionUser->set('user',$_POST['username']);

        header('Location: homepage');
            }

        return $this->render('connexion/connexion.html.twig');
    }

    /**
     * @Route("/logout")
     */
    public function logoutAction()
    {
        $sessionUser = new Session();
        $sessionUser->invalidate();

        return $this->render('connexion/connexion.html.twig');

    }
}
