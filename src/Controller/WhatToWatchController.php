<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WhatToWatchController extends AbstractController
{
    /**
     * @Route("/", name="/")
     */
    public function index()
    {
        
        return $this->render('what_to_watch/index.html.twig', [
            'title' => 'WhatToWatch',
        ]);
    }
}
