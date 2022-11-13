<?php

namespace App\Controller;

use Faker\Factory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @route("/article", name="blog")
     */

    public function index(): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    /**
     * @route("/article/list", name="arrays")
     */
    public function array(): Response
    {
        $nb = [];
        for ($i = 0; $i < 10; $i++) {
            // rand() crée un chiffre random, array_push l'insere dans le tab
            $random_int = rand(1, 100);
            array_push($nb, $random_int);
        }

        return $this->render(
            'article/list.html.twig',
            [
                'titre_nb' => 'Voici la liste des items:',
                'tab_nombres' => $nb
            ]
        );
    }

    /**
     * @route("/article/string", name="articles")
     */
    public function array_first(): Response
    {
        $tabString = [
            "lorem ipsum dolor sit amet consectetur adipiscing elit",
            "mus eros aptent tincidunt tristique nulla ut aliquet",
            "orci potenti vehicula laoreet porta ultrices"
        ];
        return $this->render(
            'article/string.html.twig',
            [
                'titre_string' => 'Voici le premier item du tableau de string:',
                'tab_string' => $tabString
            ]
        );
    }

    /**
     * @route("/article/date", name="date")
     */

    public function date(): Response
    {

        $date_random = rand(strtotime("Jan 01 2013"), strtotime("Dec 01 2033"));
        //  = date("d.m.Y", $timestamp);
        // $current_date = date("d.m.Y");

        return $this->render(
            'article/date.html.twig',
            [
                'titre_date' => 'Date',
                'date_rand' => $date_random

            ]
        );
    }

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
}
