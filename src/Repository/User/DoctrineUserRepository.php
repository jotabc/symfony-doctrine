<?php

namespace App\Repository\User;

use App\Entity\User;
use App\Repository\DoctrineBaseRepository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

class DoctrineUserRepository extends DoctrineBaseRepository
{
    protected static function entityClass(): string
    {
        return User::class;
    }

    public function findOneById(string $id): ?User
    {
        return $this->objectRepository->find($id);
    }

    public function findOneByIdWithQueryBuilder(string $id): ?User
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        
        $query = $qb
            ->select('user')
            ->from(User::class, 'user')
            ->where('user.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getOneOrNullResult();
    }

    public function findOneByIdWithDQL(string $id): ?User
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT u FROM App\Entity\User u WHERE u.id = :id')
            ->setParameter('id', $id);
        
        return $query->getOneOrNullResult();
        
    }

    public function findOneByIdWithNativeSQL(string $id): ?User
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata(User::class, 'u');

        $query = $this->getEntityManager()
            ->createNativeQuery('SELECT * FROM users WHERE id = :id', $rsm);

        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();

    }

    // es la màs ràpida, porque es código nativo SQL que devuelve un array y no
    // convierte a un objeto mi clase.
    public function findOneByIdWithPlainSQL(string $id): array
    {
        $params = [
            ':id' => $this->getEntityManager()->getConnection()->quote($id)
        ];

        $query = 'SELECT * FROM users WHERE id = :id';

        return $this->getEntityManager()
            ->getConnection()
            ->executeQuery(\strtr($query, $params))
            ->fetchAllAssociative();

    }

    public function save(User $user): void
    {
        $this->saveEntity($user);
    }

    public function remove(User $user): void
    {
        $this->removeEntity($user);
    }

    /** 
     * @return User[]
     */
    public function all(): array
    {
        return $this->objectRepository->findAll();
    }

    // el iterable lo que va a ha hacer es crear un stream de datos, que la memoria se va a mantener
    // con el clear vamos a usar el garbage colector para liberar memoria
    // como vemos nos pemirte también ir haciendo la operación en batches
    
    public function updateAllWithIterable(): void
    {
        $batchSize = 100;
        $i = 1;
        // DQL => este usar el namespace donde esta el entity.
        $query = $this->getEntityManager()->createQuery('SELECT u FROM App\Entity\User u');

        foreach ($query->toIterable() as $user) {
            $user->updateScore();

            ++$i;
            if (($i % $batchSize) === 0) {
                $this->getEntityManager()->flush(); //Execute all updates
                $this->getEntityManager()->clear();
            }
        }
        $this->getEntityManager()->flush();
    }

}