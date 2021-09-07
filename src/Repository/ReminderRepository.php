<?php

namespace App\Repository;

use App\Entity\Reminder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reminder|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reminder|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reminder[]    findAll()
 * @method Reminder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReminderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reminder::class);
    }

    public function transform(Reminder $reminder)
    {
        return [
            'id'    => (int) $reminder->getId(),
            'slug' => (int) $reminder->getSlug(),
            'text' => (string) $reminder->getText(),
            //'date_created' => (date) $reminder->getCreatedOnDate(),
            //'category_id' => (int) $reminder->getCategory()
        ];
    }

    public function transformAll()
    {
        $reminders = $this->findAll();
        $remindersArray = [];

        foreach ($reminders as $reminder) {
            $remindersArray[] = $this->transform($reminder);
        }

        return $remindersArray;
    }

    // /**
    //  * @return Reminder[] Returns an array of Reminder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Reminder
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
