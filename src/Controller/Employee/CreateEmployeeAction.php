<?php 

namespace App\Controller\Employee;

use App\Controller\ApiController;
use App\Http\Response\ApiResponse;
use App\Repository\Employee\DoctrineEmployeeRepository;

class CreateEmployeeAction extends ApiController
{
    public function __construct(
        private DoctrineEmployeeRepository $employeeRepo,
    ) {
        
    }

    public function __invoke(): ApiResponse
    {
        $this->employeeRepo->createEmployeeAndCarWithTransaction();

        return $this->createResponse(['status' => 'ok']);
    }


}