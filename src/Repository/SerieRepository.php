<?php

namespace App\Repository;

use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Serie>
 *
 * @method Serie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Serie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Serie[]    findAll()
 * @method Serie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Serie::class);
    }

    public function findBestSeries() {
        //En DQL
        $entityManager = $this->getEntityManager();
        $dql = "
            SELECT s 
            FROM App\Entity\Serie s
            WHERE s.popularity > 100
            AND s.vote > 8
            ORDER BY s.popularity DESC
       ";
        $query = $entityManager->createQuery($dql);
        $query->setMaxResults(50);
//        $results = $query->getOneOrNullResult();
        $results = $query->getResult();

//        Version querieBuilder
        $queryBuilder = $this->createQueryBuilder('s');
        $queryBuilder->andWhere('s.s.popularity > 100');
        $queryBuilder->andWhere('s.vote > 8');
        $queryBuilder->addOrderBy('s.s.popularity', 'DESC');
        $query = $queryBuilder->getQuery();

        $query = $entityManager->createQuery($dql);
        $query->setMaxResults(50);
//        $results = $query->getOneOrNullResult();
        $results = $query->getResult();

        return $results;
}

}