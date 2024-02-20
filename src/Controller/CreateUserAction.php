<?php

namespace App\Controller;

use App\Service\CreateUserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateUserAction extends AbstractController
{
    public function __construct(
        private CreateUserService $service,
    ) {
        
    }

    public function __invoke(Request $request)
    {   
        $data = \json_decode($request->getContent(), true);

        $user = $this->service->__invoke($data['name'], $data['email']);

        return new JsonResponse([
            'user' => [
                'id' => $user->getId(), 
                'name' => $user->getName(), 
                'email' => $user->getEmail(), 
                'createdOn' => $user->getCreatedOn()->format(\DateTime::RFC3339), 
            ]
        ], JsonResponse::HTTP_CREATED);
    }
}
