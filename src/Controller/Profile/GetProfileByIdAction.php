<?php

namespace App\Controller\Profile;

use App\Controller\ApiController;
use App\Http\Response\ApiResponse;
use App\Service\Profile\GetProfileByIdService;
use Symfony\Component\HttpFoundation\Request;

class GetProfileByIdAction extends ApiController
{
    public function __construct(
        private GetProfileByIdService $service
    ) {
        
    }

    public function __invoke(Request $request, string $id): ApiResponse
    {
       $profile = $this->service->__invoke($id);
       
       return $this->createResponse(['profile' => $profile->toArray()]); 
        
    }
    
}