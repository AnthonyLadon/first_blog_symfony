<?php

/* 
L'un des composants de l'acronyme MVC, le contrôleur est une fonction PHP qui permet de lire une 
requête et renvoyer une réponse (qui peut être du HTML, JSON ou binary file tel qu’une image ou 
un PDF).
 */


namespace App\Controller;

// importer 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */

    // route vers page d'accueil (Ici pas de parametre à passer)
    public function index(): Response
    {
        return $this->render('article/index.html.twig');
    }
};
