<?php

namespace App\Repository\Profile;

use App\Entity\Profile;
use App\Repository\DoctrineBaseRepository;

class DoctrineProfileRepository extends DoctrineBaseRepository
{
    protected static function entityClass(): string
    {
        return Profile::class;
    }

    public function findOneById(string $id): ?Profile
    {
        return $this->objectRepository->find($id);
    }

}