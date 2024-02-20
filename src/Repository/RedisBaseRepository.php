<?php

namespace App\Repository;

abstract class RedisBaseRepository
{
    protected function saveEntity(object $entity): void
    {
        // some logic
    }
}