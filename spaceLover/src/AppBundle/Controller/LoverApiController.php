<?php

namespace AppBundle\Controller;


use AppBundle\Service\LoverApiFetch;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/list")
 */
class LoverApiController extends Controller
{
    /**
     * @Route("/")
     * @Method({"GET","POST"})
     */
    public function listAction(Request $request)
    {
        $api = new LoverApiFetch();
        $lovers = $api->getAll();

        $gender = '';
        if ($request->getMethod() == 'POST') {

            $gender->$request->request->get('question');

            $templateVariables = [
                'gender' => $gender];

            return $this->redirectToRoute('LoverApi/list.html.twig', $templateVariables);
        }

        return $this->render('LoverApi/list.html.twig', [
            'lovers' => $lovers,
        ]);


    }



}