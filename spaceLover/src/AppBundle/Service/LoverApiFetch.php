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

    public function getBySpecies($gender, $species)
    {
        $datas = $this->getAllByGender($gender);
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
        //$datas = $this->getBySpecies($gender, $species);
        $datasByAge = [];
        if ($choice === 1) {
            foreach ($datas as $data) {
                if (isset($data->born) && !isset($data->died) && $data->born < -40 || !isset($data->born)) {
                    $datasByAge[] = $data;
                }
            }
        }
        if ($choice === 0) {
            foreach ($datas as $data) {
                if (isset($data->born) && !isset($data->died) && $data->born >= -40) {
                    $datasByAge[] = $data;
                }
            }
        }
        if ($choice === 2) {
            foreach ($datas as $data) {
                if (isset($data->died)) {
                    $datasByAge[] = $data;
                }
            }
        }
        return $datasByAge;
    }

    public function getByHeight ($gender, $species, $choice, $choice2)
    {
        $datas = $this->getByAge($gender, $species, $choice);
        $datasByHeight = [];
        if ($choice2 == 0) {
            foreach ($datas as $data) {
                if ($data->height < 1) {
                    $datasByHeight[] = $data;
                }
            }
        }
        if ($choice2 == 1) {
            foreach ($datas as $data) {
                if ($data->height > 1 && $data->height < 2) {
                    $datasByHeight[] = $data;
                }
            }
        }
        if ($choice2 == 2) {
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