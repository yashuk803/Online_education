<?php

namespace App\Repository;

use App\Entity\Course;
use App\Entity\Lesson;
use App\Lesson\Repository\LessonRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method null|Lesson find($id, $lockMode = null, $lockVersion = null)
 * @method null|Lesson findOneBy(array $criteria, array $orderBy = null)
 * @method Lesson[]    findAll()
 * @method Lesson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LessonRepository extends ServiceEntityRepository implements lessonRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Lesson::class);
    }

    public function findByCourse(int $courseId)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.course = :course')
            ->setParameter('course', $courseId)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findById(int $id)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
