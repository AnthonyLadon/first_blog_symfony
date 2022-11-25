<?php

namespace App\Controller;

use DateTime;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
     * @route("/article/string")
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
     * @Route("article/detail{numero}")
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

    // public function new(EntityManagerInterface $entityManager): Response
    // {
    // $article = new Article();
    // $article->setTitre('Mon article 1');
    // $article->setContenu('Lorem ipsum dolor sit amet,adised temlis.');
    // $article->setDate(new DateTime("2015-03-14 00:00"));

    // $article = new Article();
    // $article->setTitre('Mon article 2');
    // $article->setContenu('Lorem ipsum dolor magique sit amet,adised temlis.');
    // $article->setDate(new DateTime("2018-01-01 00:00"));

    // $article = new Article();
    // $article->setTitre('Mon article 3');
    // $article->setContenu('Lorem ipsum dolor sit amet,adised temlis.');
    // $article->setDate(new DateTime("2021-01-01 00:00"));

    // $entityManager->persist($article);
    // $entityManager->flush();

    // Pour effacer:
    // $entityManager->remove($article);
    // $entityManager->flush();

    // return new Response("Article bien envoyé en base de donnée");
    // }


    /**
     * @Route("article/liste", name="articles")
     */

    public function listeArticles(EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Article::class);

        $article = $repository->findAll();

        return $this->render(
            'article/listeArticles.html.twig',
            ['article' => $article]
        );
    }

    /**
     * @Route("article/detail/{id}", name="afficher_article")
     */

    public function detailArticles($id, EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Article::class);

        $article = $repository->find($id);

        return $this->render(
            'article/detail.html.twig',
            [
                'article' => $article
            ]
        );
    }


    /**
     * @Route("article/liste/contenu/{contenu}", name="afficherParContenu")
     */

    public function articleParMotClef($contenu, EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Article::class);
        $article = $repository->findByContent($contenu);

        return $this->render('article/listeArticles.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("article/liste/annee/{annee}", name="afficherParAnnee")
     */

    public function articleParAnnee($annee, EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Article::class);
        $article = $repository->findByYear($annee);

        return $this->render('article/listeArticles.html.twig', [
            'article' => $article,
        ]);
    }


    // afficher un article via une requête automatique 
    // ici pas besoin de déclarer le entity manager
    // il va chercher par défaut la requête correspondant a l'argument en paramètre (ici id)

    /**
     * @Route("/article/afficher/{id}", name="afficherById") 
     */
    public function afficherById(Article $article): Response
    {
        return $this->render('article/detail.html.twig', [
            'article' => $article
        ]);
    }

    // ajouter une fonction de vote POST ONLY 
    /**
     * @Route("/article/afficher/{id}/voter", name="article_vote", methods="POST") 
     */
    public function articleVote(Article $article, Request $request, EntityManagerInterface $entityManager)
    {
        // afficher l'article et le contenu de a requête 
        // dd($article, $request->request->all());

        // récupérer la valeur de la direction via l'objet request 
        $direction = $request->request->get('direction');

        if ($direction === 'up') {
            //  $article->setVotes($article->getVotes() + 1); 
            $article->upVote();
        } elseif ($direction === 'down') {
            //  $article->setVotes($article->getVotes() - 1); 
            $article->downVote();
        }
        $entityManager->flush();

        // affichera votre URL article/voter
        return $this->render('article/detail.html.twig', ['article' => $article,]);
        // redirige vers la route d’affichage d’un article
        return $this->redirectToRoute('afficherById', ['id' => $article->getId()]);
    }
}
