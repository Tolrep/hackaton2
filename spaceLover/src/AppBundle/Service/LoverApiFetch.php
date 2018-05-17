<?php

namespace AppBundle\Service;

use GuzzleHttp\Client;

class LoverApiFetch
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://akabab.github.io/starwars-api/api/',
        ]);
    }

    public function getAll()
    {
        $response = $this->client->request('GET', 'all.json');
        return json_decode($response->getBody()->getContents());
    }

    public function getAllByGender($gender)
    {
        $response = $this->client->request('GET', 'all.json');
        $datas = json_decode($response->getBody()->getContents());
        $datasByGender= [];
        foreach ($datas as $data) {
            if ($data->gender == $gender) {
                $datasByGender[] = $data;
            }
        }
    return $datasByGender;
    }

    public function getBySpecies($datas, $species)
    {
        $datasBySpecies = [];
        foreach ($datas as $data) {
            if ($data->species == $species) {
                $datasBySpecies[] = $data;
            }
        }
        return $datasBySpecies;
    }

    public function getByAge($datas, $choice)
    {
        $datasByAge = [];
        if ($choice == 0) {
            foreach ($datas as $data) {
                if (!isset($data->died) && $data->born < -10) {
                    $datasByAge[] = $data;
                }
            }
        }
        if ($choice == 1) {
            foreach ($datas as $data) {
                if (!isset($data->died) && $data->born > -10) {
                    $datasByAge[] = $data;
                }
            }
        }
        if ($choice == 2) {
            foreach ($datas as $data) {
                if (isset($data->died)) {
                    $datasByAge[] = $data;
                }
            }
        }
        return $datasByAge;
    }

    public function getByHeight ($datas, $choice)
    {
        $datasByHeight = [];
        if ($choice == 0) {
            foreach ($datas as $data) {
                if ($data->height < 1) {
                    $datasByHeight[] = $data;
                }
            }
        }
        if ($choice == 1) {
            foreach ($datas as $data) {
                if ($data->height > 1 && $data->height < 2) {
                    $datasByHeight[] = $data;
                }
            }
        }
        if ($choice == 2) {
            foreach ($datas as $data) {
                if ($data->height > 2) {
                    $datasByHeight[] = $data;
                }
            }
        }
        return $datasByHeight;
    }

    public function getOneById($id)
    {
        $response = $this->client->request('GET', 'all.json');
        $datas = json_decode($response->getBody()->getContents());
        foreach ($datas as $data) {
            if ($data->id == $id) {
                $perso = $data;
            }
        }
        return $perso;
    }



}