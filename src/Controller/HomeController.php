<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{

    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('/home/index.html.twig', [
            'title' => 'Accueil',
        ]);
    }

    /**
     * @Route("/movies_show/{list}", name="movies_show")
     */
    public function movies_Show(HttpClientInterface $httpClient, string $list)
    {
        $this->list = $list;

        $response = $httpClient->request(
            'GET',
            "https://imdb-api.com/fr/API/IMDbList/k_v91d9g6r/{$this->list}"
        );

        $response->getStatusCode();
        // $statusCode = 200
        $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $response->getContent();

        // dd($response->toArray());
        return $this->render('/home/movies.html.twig', [
            'controller_name' => 'HomeController',
            'list' => $list,
            'movies' => $response->toArray(),
        ]);
    }

    /**
     * @Route("/series_show/{list}", name="series_show")
     */
    public function series_Show(HttpClientInterface $httpClient, string $list)
    {
        $this->list = $list;

        $response = $httpClient->request(
            'GET',
            "https://imdb-api.com/fr/API/IMDbList/k_v91d9g6r/{$this->list}"
        );

        $response->getStatusCode();
        // $statusCode = 200
        $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $response->getContent();

        // dd($response->toArray());
        return $this->render('/home/series.html.twig', [
            'controller_name' => 'HomeController',
            'list' => $list,
            'series' => $response->toArray()

        ]);
    }
}
