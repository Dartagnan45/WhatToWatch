<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    private $genres = [
        'Action' => 'ls009668579',
        'Aventure' => 'ls009609925',
        'Comédie' => 'ls009668747',
        'Drame' => 'ls066055776',
        'Fantaisie' => 'ls009669258',
        'Horreur' => 'ls066355376',
        'Thriller' => 'ls009668314',
        'Science fiction' => 'ls009668082',
        'Romance' => 'ls095095429'

    ];

    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $genres = $this->getGenres();
        return $this->render('/home/index.html.twig', [
            'title' => 'Accueil',
            'genres' => $genres
        ]);
    }

    /**
     * @Route("/movies_show/{list}", name="movies_show")
     */
    public function movies_Show(HttpClientInterface $httpClient, string $list)
    {
        $genres = $this->getGenres();
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
            'genres' => $genres,
            'movies' => $response->toArray(),
            'title' => 'Liste des 50 meilleurs films '
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

    /**
     * Get the value of lists
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * Set the value of lists
     *
     * @return  self
     */
    public function setGenress($genres)
    {
        $this->genres = $genres;

        return $this;
    }
}
