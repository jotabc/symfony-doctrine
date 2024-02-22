<?php

namespace App\Service\Employee;

use App\Repository\Employee\DoctrineEmployeeRepository;

class GetEmployeeService
{
    public function __construct(
        private DoctrineEmployeeRepository $doctrineEmployeeRepository
    ) {
        
    }

    public function __invoke(): array
    {
        return $this->doctrineEmployeeRepository->getAll(); 
    }
}