<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    protected $genres = [
        'Action' => 'ls009668579',
        'Aventure' => 'ls009609925',
        'Comédie' => 'ls009668747',
        'Drame' => 'ls066055776',
        'Fantaisie' => 'ls009669258',
        'Horreur' => 'ls066355376',
        'Thriller' => 'ls009668314',
        'Science-fiction' => 'ls009668082',
        'Romance' => 'ls095095429',
        'series' => 'ls052258183'
    ];

    // clé TMDB
    protected $key = '956fb5e5877765d8c3dcb875e29737e5';

    // example API TMDB
    // https://api.themoviedb.org/3/list/{list_id}?api_key=<<$key>>&language=fr-FR
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $genres = $this->getGenres();

        return $this->render('/home/index.html.twig', [
            'title' => 'Accueil',
            'genres' => $genres,
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
            'title_films' => 'Liste des 50 meilleurs films genre : ',
            'title_series' => 'Top 50 des meilleures '
        ]);
    }

    /**
     * @Route("/content/{title}", name="content")
     */
    public function content_show(HttpClientInterface $httpClient, string $title)
    {
        $genres = $this->getGenres();
        $this->title = $title;

        $response = $httpClient->request(
            'GET',
            "https://imdb-api.com/fr/API/Title/k_v91d9g6r/{$this->title}"
        );

        $response->getStatusCode();
        // $statusCode = 200
        $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $response->getContent();


        return $this->render('/home/content.html.twig', [
            'movie' => $response->toArray(),
            'genres' => $genres,
            'title' => $title,
        ]);
    }

    /**
     * @Route("/trailer/{id}", name="trailer")
     */
    public function trailer(HttpClientInterface $httpClient, string $id)
    {
        $genres = $this->getGenres();
        $this->id = $id;

        $response = $httpClient->request(
            'GET',
            "https://imdb-api.com/fr/API/YouTubeTrailer/k_v91d9g6r/{$this->id}"
        );

        $response->getStatusCode();
        // $statusCode = 200
        $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $response->getContent();

        return $this->render('/home/trailer.html.twig', [
            'genres' => $genres,
            'trailer' => $response->toArray()
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
    public function setGenres($genres)
    {
        $this->genres = $genres;

        return $this;
    }
}
