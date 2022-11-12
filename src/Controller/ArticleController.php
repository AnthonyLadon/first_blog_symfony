<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @route("/article")
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
     * @route("/article/string")
     */
    public function array_string(): Response
    {
        return $this->render(
            'article/string.html.twig',
            [
                'titre_string' => 'Voici le premier item du tableau de string:'
            ]
        );
    }
}
