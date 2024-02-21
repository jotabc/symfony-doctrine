<?php

namespace App\Controller\User;

use App\Controller\ApiController;
use App\Http\Response\ApiResponse;
use App\Service\User\GetUserByIdService;

class GetUserByIdAction extends ApiController
{
    public function __construct(
        private GetUserByIdService $service
    ) {
        
    }

    public function __invoke(string $id): ApiResponse
    {
        $user = $this->service->__invoke($id);

        return $this->createResponse([
            'user' => $user->toArray()
        ]);
        
    }
}