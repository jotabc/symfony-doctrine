<?php

namespace App\Repository\Employee;

use App\Entity\Employee;
use App\Repository\DoctrineBaseRepository;

class DoctrineEmployeeRepository extends DoctrineBaseRepository
{

    protected static function entityClass(): string
    {
        return Employee::class;
    }

    /**
     * @return Employee[]
     */
    public function getAll(): array
    {
        return $this->objectRepository->findAll();
    }

    public function save(Employee $employee): void
    {
        $this->saveEntity($employee);
    }

}