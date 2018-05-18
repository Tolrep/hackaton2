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
        shuffle($lovers);

        if ($request->query->get('gender')) {
            $gender = $request->query->get('gender');

            $datasByGenders = $api->getAllByGender($gender);
            shuffle($datasByGenders);

            if ($request->query->get('species')) {
                $gender = $request->query->get('gender');
                $species = $request->query->get('species');

                $datasBySpecies = $api->getBySpecies($datasByGenders, $species);
                shuffle($datasBySpecies);

                if($request->query->get('age')) {
                    $gender = $request->query->get('gender');
                    $species = $request->query->get('species');
                    $age = $request->query->get('age');

                    $datasByAge = $api->getByAge($datasBySpecies, $age);
                    shuffle($datasByAge);
                    if ($datasByAge == []) {
                        $winner = [];
                        $winner[] = $api->getOneById(16);
                        $winner[] = $api->getOneById(83);
                        $winner[] = $api->getOneById(53);
                        $winner[] = $api->getOneById(13);
                        $winner[] = $api->getOneById(49);
                        $winner[] = $api->getOneById(45);
                        shuffle($winner);
                        $price = rand(250, 2000);
                        $templateVariables = [
                            'lover' => $winner[0],
                            'price' => $price,
                            'noPlanet' => 'la bordure extèrieur',
                        ];

                        return $this->render('LoverApi/match.html.twig', $templateVariables);
                    }

                    if ($request->query->get('height')) {
                        $height = $request->query->get('height');

                        $datasByHeight = $api->getByHeight($datasByAge, $height);
                        if ($datasByHeight == []) {
                            $winner = [];
                            $winner[] = $api->getOneById(16);
                            $winner[] = $api->getOneById(83);
                            $winner[] = $api->getOneById(53);
                            $winner[] = $api->getOneById(13);
                            $winner[] = $api->getOneById(49);
                            $winner[] = $api->getOneById(45);
                            shuffle($winner);
                            $price = rand(250, 2000);
                            $templateVariables = [
                                'lover' => $winner[0],
                                'price' => $price,
                                'noPlanet' => 'la bordure extèrieur',
                            ];

                            return $this->render('LoverApi/match.html.twig', $templateVariables);
                        }
                        shuffle($datasByHeight);

                        $winner = $datasByHeight[0];
                        $price = rand(250,2000);

                        $templateVariables = [
                            'lover' => $winner,
                            'price' => $price,
                            'noPlanet' => 'la bordure extèrieur',
                        ];

                        return $this->render('LoverApi/match.html.twig', $templateVariables);
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
