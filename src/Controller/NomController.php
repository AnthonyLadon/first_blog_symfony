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


class NomController
{
    /**
     * @Route("/nom")
     */

    public function MonNom(): Response
    {
        return new Response(
            '<html><body>Hello I\'m Anthony Ladon</body></html>'
        );
    }

    /**
     * @Route("/nombre")
     */

    public function number(): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Mon nombre: ' . $number . '</body></html>'
        );
    }
};
