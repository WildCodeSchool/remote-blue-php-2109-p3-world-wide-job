<?php

namespace App\Repository;

use App\Entity\Application;
use App\Entity\Company;
use App\Entity\Offer;
use App\Entity\School;
use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Application|null find($id, $lockMode = null, $lockVersion = null)
 * @method Application|null findOneBy(array $criteria, array $orderBy = null)
 * @method Application[]    findAll()
 * @method Application[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Application::class);
    }

    /**
     * @return float|int|mixed|array|string
     */
    public function findLikeStudent(string $student)
    {
        return $this->createQueryBuilder('a')
            ->Where('u.firstname LIKE :student')
            ->orWhere('u.lastname LIKE :student')
            ->setParameter('student', '%' . $student . '%')
            ->join('a.student', 's')
            ->join('s.user', 'u')
            ->join('a.offer', 'o')
            ->join('o.company', 'c')
            ->join('s.school', 'sc')
            ->select(
                'u.firstname',
                'u.lastname',
                'u.city',
                'u.zip',
                's.picture',
                'a.status',
                's.ine',
                's.id',
                'sc.schoolName',
                'a.status'
            )
            ->getQuery()
            ->getResult();
    }

    /**
     * @return float|int|mixed|array|string
     */
    public function findBySchool(School $school)
    {
        return $this->createQueryBuilder('a')
            ->Where('s.school = :school')
            ->setParameter('school', $school)
            ->join('a.student', 's')
            ->join('s.user', 'u')
            ->join('a.offer', 'o')
            ->join('o.company', 'c')
            ->join('s.school', 'sc')
            ->select(
                'u.firstname',
                'u.lastname',
                'u.city',
                'u.zip',
                's.picture',
                'a.status',
                's.ine',
                's.id',
                'sc.schoolName',
                'a.status'
            )
            ->groupBy('a')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return float|int|mixed|array|string
     */
    public function findByOffer(Offer $offer)
    {
        return $this->createQueryBuilder('a')
            ->Where('a.offer = :offer')
            ->setParameter('offer', $offer)
            ->join('a.student', 's')
            ->join('s.user', 'u')
            ->join('a.offer', 'o')
            ->join('o.company', 'c')
            ->join('s.school', 'sc')
            ->select(
                'u.firstname',
                'u.lastname',
                'u.city',
                'u.zip',
                's.picture',
                'a.status',
                's.ine',
                's.id',
                'sc.schoolName',
                'a.status'
            )
            ->groupBy('a')
            ->getQuery()
            ->getResult();
    }


    /**
     * @param Company $company
     * @return float|int|mixed|string
     */
    public function findAllSchoolByCompany(Company $company)
    {
        $query = $this->createQueryBuilder('a')
            ->where('o.company = :company')
            ->setParameter('company', $company)
            ->join('a.student', 's')
            ->join('s.user', 'u')
            ->join('a.offer', 'o')
            ->join('o.company', 'c')
            ->join('s.school', 'sc')
            ->select('sc.schoolName')
            ->groupBy('a');


        // returns an array of Product objects
        return $query->getQuery()->getResult();
    }


    /**
     * @param Company $company
     * @return float|int|mixed|string
     */
    public function findAllApplicationsByCompany(Company $company)
    {
        $query = $this->createQueryBuilder('a')
            ->where('o.company = :company')
            ->setParameter('company', $company)
            ->join('a.student', 's')
            ->join('s.user', 'u')
            ->join('a.offer', 'o')
            ->join('o.company', 'c')
            ->join('s.school', 'sc')
            ->select(
                'u.firstname',
                'u.lastname',
                'u.city',
                'u.zip',
                's.picture',
                'a.status',
                's.ine',
                's.id',
                'sc.schoolName',
                'a.status'
            )
            ->groupBy('a');

        // returns an array of Product objects
        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Application[] Returns an array of Application objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Application
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
