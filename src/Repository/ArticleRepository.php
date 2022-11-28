<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function save(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Article[] Returns an array of Article objects
     */

    public function findByContent($contenu)
    {
        return $this->createQueryBuilder('a')
            // ici :contenu est une variable
            ->andWhere('a.contenu like :contenu')
            // on set la valeur de la key 'contenu' avec '% . $contenu . %'
            ->setParameter('contenu', '%' . $contenu . '%')
            ->orderBy('a.date', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }


    /**
     * @return Article[] Returns an array of Article objects
     */

    public function findByYear($annee)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.date like :annee')
            ->setParameter('annee', '%' . $annee . '%')
            ->orderBy('d.date', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }


    /**
     * @return Article[] Returns an array of Article objects
     */

    // Recherche une liste d'articles par leur categorie 
    public function AfficherArticleParCategorie($id_cat)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.Categorie = :categ')
            ->setParameter('categ', $id_cat)
            ->orderBy('a.titre', 'ASC')
            ->getQuery()
            ->getResult();
    }



    //    /**
    //     * @return Article[] Returns an array of Article objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Article
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

}
