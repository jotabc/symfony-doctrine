<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\DoctrineUserRepository;

class CreateUserService
{

    public function __construct(
        private DoctrineUserRepository $userRepository,
    )
    {
        
    }

    public function __invoke(string $name, string $email): User
    {
        // aquí igual hacemos y controlamos los errores como por ejm verificar si es email ya existe
        $user = new User($name, $email);
        
        $this->userRepository->save($user);

        return $user;        
    }

    
}