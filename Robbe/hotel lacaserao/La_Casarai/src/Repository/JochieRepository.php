<?php

namespace App\Repository;

use App\Entity\Jochie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Jochie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jochie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jochie[]    findAll()
 * @method Jochie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JochieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Jochie::class);
    }

    // /**
    //  * @return Jochie[] Returns an array of Jochie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Jochie
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
