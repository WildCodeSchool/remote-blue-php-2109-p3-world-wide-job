<?php

namespace App\Repository;

use App\Entity\Company;
use App\Entity\Offer;
use App\Entity\Application;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Offer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offer[]    findAll()
 * @method Offer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offer::class);
    }

     /**
     * @return float|int|mixed|array|string
     */
    public function findLikeCity(string $city)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.city LIKE :city')
            ->setParameter('city', '%' . $city . '%')
            ->orderBy('o.dateOfPublication', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param Company $company
     * @return float|int|mixed|string
     */
    public function findAllCountApplications(Company $company)
    {
        $query = $this->createQueryBuilder('o')
            ->where('c = :company')
            ->setParameter('company', $company)
            ->addSelect('count(a) AS count')
            ->leftJoin('o.applications', 'a')
            ->join('o.company', 'c')
            ->groupBy('o')
        ;

        // returns an array of Product objects
        return $query->getQuery()->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Offer
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
