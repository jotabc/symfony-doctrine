<?php

namespace App\Controller\Employee;

use App\Controller\ApiController;
use App\Entity\Employee;
use App\Http\Response\ApiResponse;
use App\Service\Employee\GetEmployeeService;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetEmployeeAction extends ApiController
{
    public function __construct(
        private GetEmployeeService $service
    ) {
        
    }

    public function __invoke(): ApiResponse
    {
        $employees = $this->service->__invoke();

        $result = array_map(function (Employee $employee): array {
            return $employee->toArray();
        }, $employees);

        return $this->createResponse(['employees' => $result], JsonResponse::HTTP_OK);
    }
    
}