<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save($user): void
    {
        // aquí podemos hacer las excepciones, capturarlas con un try catch y convertirlas
        // en excepciones de nuestro dominio.
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function findOneById(string $id): ?User
    {
        return $this->find($id);
    }

}