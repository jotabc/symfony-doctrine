<?php

namespace App\Controller\User;

use App\Controller\ApiController;
use App\Http\Response\ApiResponse;
use App\Service\User\UpdateUserService;
use Symfony\Component\HttpFoundation\Request;

class UpdateUserAction extends ApiController
{
    public function __construct(
        private UpdateUserService $service,
    ) {
        
    }

    public function __invoke(Request $request, string $id): ApiResponse
    {   
        $data = \json_decode($request->getContent(), true);

        $user = $this->service->__invoke($id, $data['name']);

        return $this->createResponse(['user' => $user->toArray()]);
    }
}
