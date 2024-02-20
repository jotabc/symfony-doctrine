<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\DoctrineUserRepository;
use App\Repository\RedisUserRepository;
use App\Repository\UserRepository;

class UpdateUserService
{

    public function __construct(
        private DoctrineUserRepository $doctrineUserRepository,
        private RedisUserRepository $redisUserRepository
    ) {

    }

    public function __invoke(string $id, string $name): User
    {
        if (null !== $user = $this->doctrineUserRepository->findOneByIdWithDQL($id)) {
            $user->setName($name);

            $this->doctrineUserRepository->save($user);
            $this->redisUserRepository->save($user);

            return $user;
        }
    }

}