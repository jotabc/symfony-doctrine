<?php

namespace App\Repository\Redis;

abstract class RedisBaseRepository
{
    protected function saveEntity(object $entity): void
    {
        // some logic
    }
}