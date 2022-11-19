<?php

namespace App\Controller;

use App\Entity\Article;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
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

        $date_random = rand(strtotime("Jan 01 2020"), strtotime("Dec 01 2025"));
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

    /**
     * @Route("article/detail{numero}", name="detail")
     */

    // A FAIRE: passer paramêtre numero dans la route 
    public function detail($numero)
    {
        return $this->render(
            'article/detail.html.twig',
            [
                'numero' => $numero
            ]
        );
    }

    /**
     * @Route("article/ajout")
     */

    public function new(EntityManagerInterface $entityManager): Response
    {
        $article = new Article();
        $article->setTitre('Mon article');
        $article->setContenu('Lorem ipsum dolor sit amet,adised temlis.');
        $article->setDate(new DateTime(2015 - 01 - 01));

        // $article2 = new Article();
        // $article2->setTitle('Mon article');
        // $article2->setContent('Lorem ipsum dolor magique sit amet,adised temlis.');
        // $article2->setCreationDate(new DateTime(2018 - 01 - 01));

        // $article3 = new Article();
        // $article3->setTitle('Mon article');
        // $article3->setContent('Lorem ipsum dolor sit amet,adised temlis.');
        // $article3->setCreationDate(new DateTime(2021 - 01 - 01));

        $entityManager->persist($article);
        $entityManager->flush();

        return new Response("Article bien envoyé en base de donnée");
    }
}
