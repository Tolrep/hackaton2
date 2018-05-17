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
        $datas= json_decode($response->getBody()->getContents());

        $select=$datas->getDatas();
        return $select;
    }
}