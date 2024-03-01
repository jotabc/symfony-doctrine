<?php

namespace App\Repository\Employee;

use App\Entity\Car;
use App\Entity\Employee;
use App\Repository\DoctrineBaseRepository;
use Doctrine\ORM\EntityManagerInterface;

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

    public function removeCarFromEmployee(string $employeeId, string $carId): void
    {
        $params = [
            ':ownerId' => $this->connection->quote($employeeId),
            ':carId' => $this->connection->quote($carId),
        ];

        $query = 'DELETE from car WHERE id = :carId AND owner_id = :ownerId';
        
        $this->connection->executeQuery(strtr($query, $params));
    }

    public function createEmployeeAndCar(): void
    {
        $employee = new Employee('Oscar');
        $car = new Car('Ford', 'k', $employee);

        $this->getEntityManager()->persist($employee);
        $this->getEntityManager()->flush();

        // con este throw para ejemplificar vemos que crea un employee pero el car no entonces hay una
        // inconsistensia de datos.
        // throw new BadRequestHttpException();
        
        $this->getEntityManager()->persist($car);
        $this->getEntityManager()->flush();
    }

    // con esto nos aseguramos que si queremos persistir mas de una entidad se ejecutan todas pero
    // si falla hace un rollback y no abrá inconsistencia de datos.
    public function createEmployeeAndCarWithTransaction(): void
    {
        $employee = new Employee('Oscar');
        $car = new Car('Ford', 'k', $employee);

        $this->getEntityManager()->transactional(function (EntityManagerInterface $em) use($employee, $car): void {
            $em->persist($employee);
            $em->persist($car);
            $em->flush();
        });
    }

}