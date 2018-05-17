<?php

namespace AppBundle\Controller;


use AppBundle\Service\LoverApiFetch;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/list")
 */
class LoverApiController extends Controller
{
    /**
     * @Route("/")
     */
    public function listAction()
    {
        $api = new LoverApiFetch();
        $lovers = $api->getAll();
        return $this->render('LoverApi/list.html.twig', [
            'lovers' => $lovers,
        ]);
    }
    /**
     * @Route("/test")
     */
    public function test()
    {

        $api = new LoverApiFetch();
        $datas = $api->getAll();
        $lovers = $api->getByAge($datas, 0);
        var_dump($lovers);die;


    }
}
