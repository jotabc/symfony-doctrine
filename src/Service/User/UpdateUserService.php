<?php

namespace App\Service\User;

use App\Entity\User;
use App\Repository\User\DoctrineUserRepository;
use App\Repository\Redis\RedisUserRepository;

class UpdateUserService
{

    public function __construct(
        private DoctrineUserRepository $doctrineUserRepository,
        private RedisUserRepository $redisUserRepository
    ) {

    }

    public function __invoke(string $id, string $name): User
    {
        if (null !== $user = $this->doctrineUserRepository->findOneById($id)) {
            $user->setName($name);

            $this->doctrineUserRepository->save($user);
            $this->redisUserRepository->save($user);

            return $user;
        }
    }

}