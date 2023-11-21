<?php

namespace App\Repository;

use App\Entity\InfosContact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InfosContact>
 *
 * @method InfosContact|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfosContact|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfosContact[]    findAll()
 * @method InfosContact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfosContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfosContact::class);
    }

//    /**
//     * @return InfosContact[] Returns an array of InfosContact objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InfosContact
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
