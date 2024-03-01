<?php 

namespace App\Controller\User;

use App\Controller\ApiController;
use App\Http\Response\ApiResponse;
use App\Service\User\UpdateUserScoreService;

class UpdateUserScoreAction extends ApiController
{
    public function __construct(
        private UpdateUserScoreService $service,
    ) {
        
    }
    public function __invoke(): ApiResponse
    {
        $this->service->__invoke();

        return $this->createResponse(['status' => 'ok']);
    }
}