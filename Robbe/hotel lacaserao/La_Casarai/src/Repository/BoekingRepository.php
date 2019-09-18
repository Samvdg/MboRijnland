<?php

namespace App\Repository;

use App\Entity\Boeking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Boeking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Boeking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Boeking[]    findAll()
 * @method Boeking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoekingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Boeking::class);
    }

    public function checkDate($sDate, $eDate)
    {
//        return $this->querybuilder('b')
//            ->where('b.start < :sDate AND :eDate')
//            ->setParameter('sDate', $sDate->format('Y-m-d H:i:s'))
//            ->setParameter('eDate', $eDate->format('Y-m-d H:i:s'))
//            ->getQuery()
//            ->getResult();
        $em = $this->getEntityManager();
        $query = $em->createQuery(
                'SELECT *
                   FROM App\Entity\Room r
                   WHERE r.id IN (
                   SELECT roomId 
                   FROM App\Entity\Boeking b
                   WHERE b.start < :sDate OR :eDate AND b.end > :sDate OR :eDate)'
                )
                ->setParameter('sDate', $sDate)
                ->setParameter('eDate', $eDate);

        // returns available rooms
        return $query->execute();
        )

    }

    // /**
    //  * @return Boeking[] Returns an array of Boeking objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Boeking
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
