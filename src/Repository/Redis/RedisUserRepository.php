<?php

namespace App\Repository\Redis;

use App\Entity\User;

class RedisUserRepository extends RedisBaseRepository
{
    public function save(User $user): void
    {
        $this->saveEntity($user);
    }
}