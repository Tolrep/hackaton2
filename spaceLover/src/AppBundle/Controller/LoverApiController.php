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
     * @Route("/", name="list")
     * @Method({"GET","POST"})
     */
    public function listAction(Request $request)
    {
        $api = new LoverApiFetch();
        $lovers = $api->getAll();

        if ($request->getMethod() == 'POST') {

            $gender= $request->get('question');
            $apiGender = new LoverApiFetch();


            $templateVariables = [
                'gender' => $gender];

            return $this->redirectToRoute('list', $templateVariables);
        }

        return $this->render('LoverApi/list.html.twig', [
            'lovers' => $lovers,
        ]);
    }

    /**
     * @Route("/match/{id}")
     */
    public function matchAction($id)
    {
        $api = new LoverApiFetch();
        $lover = $api->getOneById($id);
        return $this->render('LoverApi/match.html.twig', [
            'lover' => $lover,
            'noPlanet' => 'la bordure extèrieur'
        ]);
    }
}
