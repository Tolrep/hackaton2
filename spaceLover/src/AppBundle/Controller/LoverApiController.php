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

        if ($request->query->get('gender')) {
            $gender = $request->query->get('gender');

            $datasByGenders = $api->getAllByGender($gender);

            if ($request->query->get('species')) {
                $gender = $request->query->get('gender');
                $species = $request->query->get('species');

                $datasBySpecies = $api->getBySpecies($datasByGenders, $species);

                if($request->query->get('age')) {
                    $gender = $request->query->get('gender');
                    $species = $request->query->get('species');
                    $age = $request->query->get('age');

                    $datasByAge = $api->getByAge($datasBySpecies, $age);

                    if ($request->query->get('height')) {
                        $height = $request->query->get('height');

                        $datasByHeight = $api->getByHeight($datasByAge, $height);
                        shuffle($datasByHeight);

                        $winner = $datasByHeight[0];

                        $templateVariables = [
                            'lovers' => $winner,
                        ];

                        return $this->render('LoverApi/list5.html.twig', $templateVariables);
                    }

                else{

                        $templateVariables = [
                            'gender' => $gender,
                            'species' => $species,
                            'age' => $age,
                            'lovers' => $datasByAge,
                        ];

                        return $this->render('LoverApi/list4.html.twig', $templateVariables);
                    }



                } else {
                    $templateVariables = [
                        'gender' => $gender,
                        'species' => $species,
                        'lovers' => $datasBySpecies,];

                    return $this->render('LoverApi/list3.html.twig', $templateVariables);
                }


            } else {

                $templateVariables = [
                    'gender' => $gender,
                    'lovers' => $datasByGenders,];

                return $this->render('LoverApi/list2.html.twig', $templateVariables);

            }

        } else {
            return $this->render('LoverApi/list.html.twig', [
                'lovers' => $lovers,
            ]);

        }

    }

    /**
     * @Route("/match/{id}")
     */
    public function matchAction($id)
    {
        $api = new LoverApiFetch();
        $lover = $api->getOneById($id);

        $price = rand(250,2000);

        return $this->render('LoverApi/match.html.twig', [
            'lover' => $lover,
            'noPlanet' => 'la bordure extèrieur',
            'price' => $price

        ]);
    }

}
