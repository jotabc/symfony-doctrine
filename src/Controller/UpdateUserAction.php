<?php

namespace App\Controller;

use App\Service\UpdateUserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UpdateUserAction extends AbstractController
{
    public function __construct(
        private UpdateUserService $service,
    ) {
        
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {   
        $data = \json_decode($request->getContent(), true);

        $user = $this->service->__invoke($id, $data['name']);

        return new JsonResponse([
            'user' => [
                'id' => $user->getId(), 
                'name' => $user->getName(), 
                'email' => $user->getEmail(), 
                'createdOn' => $user->getCreatedOn()->format(\DateTime::RFC3339), 
            ]
        ], JsonResponse::HTTP_OK);
    }
}
