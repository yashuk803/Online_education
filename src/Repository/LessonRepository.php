<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Repository;

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

    /**
     * {@inheritdoc}
     */
    public function save(Lesson $lesson): void
    {
        $em = $this->getEntityManager();
        $em->persist($lesson);
        $em->flush();
    }
}
