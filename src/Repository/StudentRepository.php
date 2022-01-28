<?php

namespace App\Repository;

use App\Entity\Application;
use App\Entity\Offer;
use App\Entity\School;
use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    /**
     * @param School $school
     * @return float|int|mixed|string
     */
    public function findAllNameAsc(School $school)
    {
        $query = $this->createQueryBuilder('s')
            ->where('s.school = :school')
            ->setParameter('school', $school)
            ->leftJoin('s.user', 'u')
            ->orderBy('u.firstname', 'ASC')
        ;

        // returns an array of Product objects
        return $query->getQuery()->getResult();
    }

    /**
     * @param School $school
     * @return float|int|mixed|string
     */
    public function findAllByApplication(School $school)
    {
        $query = $this->createQueryBuilder('s')
            ->where('s.school = :school')
            ->andWhere('a.status = 3')
            ->setParameter('school', $school)
            ->leftJoin('s.user', 'u')
            ->leftJoin('s.applications', 'a')
            ->orderBy('u.firstname', 'ASC')
        ;

        // returns an array of Product objects
        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Student[] Returns an array of Student objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Student
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
