<?php


namespace App\DependencyInjection;




use Symfony\Contracts\HttpClient\HttpClientInterface;

use function urlencode;

class AdresseLocator
{
    private const API_BASE = "https://api-adresse.data.gouv.fr/search/";

    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client){
        $this->client = $client;
    }

    public function localize($addressStreet , $zipCode , $town){

        //examples
        //curl "https://api-adresse.data.gouv.fr/search/?q=8+bd+du+port&postcode=44380"
        //curl "https://api-adresse.data.gouv.fr/search/?q=paris&type=street"

        $query = urlencode($addressStreet);
        $url = self::API_BASE."?q={$query}&postcode={$zipCode}&$town={$town}";

        $response = $this->client->request("GET" , $url);
        return json_decode($response->getContent(), true);
    }
}
