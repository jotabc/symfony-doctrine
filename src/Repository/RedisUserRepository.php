<?php

namespace App\Repository;

use App\Entity\User;

class RedisUserRepository extends RedisBaseRepository
{
    public function save(User $user): void
    {
        $this->saveEntity($user);
    }
}