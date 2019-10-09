<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(SessionInterface $session, ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
        $this->session = $session;
    }

    public function fillDetails($product): array
    {
        // create variables for scope
        $ids = [];
        $cart = [];
        $actualPrice = 0;
        
        // if there already are products in the cart, get them. Else return an empty array
        $ids = $this->session->get('ids', []);

        if(!empty($product)){
            // retrieving given product ID
            $Pid = $product->getId();

            // check if given product id already exists within the session..
            if(!isset($ids[$Pid])){
                $ids[$Pid] = array(
                    "id" => $Pid,
                    "quantity" => 1,
                );
            } 
            // ..if so, just 1 up the quantity
            else {
                $ids[$Pid]["quantity"]++;
            }
        }
            
        // update the session
        $this->session->set('ids', $ids);
        
        // fill in the cart with product details
        foreach($ids as $item){
            $currentProduct = $this->find($item["id"]);
            $cart[$item["id"]] = array(
                "id" => $item["id"],
                "name" => $currentProduct->getName(),
                "price" => $currentProduct->getPrice(),
                "description" => $currentProduct->getDescription(),
                "quantity" => $item["quantity"],
                "fullPrice" => $item["quantity"] * $currentProduct->getPrice(),
            );
            $actualPrice = $actualPrice + $cart[$item["id"]]["fullPrice"];
        }
        $return = array(
            "items" => $cart, 
            "actualPrice" => $actualPrice,
        );
        return $return;
    }

    public function saveDetails()
    {
        
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
