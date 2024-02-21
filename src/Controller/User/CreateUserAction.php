<?php

namespace App\Controller\User;

use App\Controller\ApiController;
use App\Http\Response\ApiResponse;
use App\Service\User\CreateUserService;
use Symfony\Component\HttpFoundation\Request;

class CreateUserAction extends ApiController
{
    public function __construct(
        private CreateUserService $service,
    ) {
        
    }

    public function __invoke(Request $request): ApiResponse
    {   
        $data = \json_decode($request->getContent(), true);

        $user = $this->service->__invoke($data['name'], $data['email']);

        return $this->createResponse(
            ['user' => $user->toArray()],
            ApiResponse::HTTP_CREATED
        );
    }
}
