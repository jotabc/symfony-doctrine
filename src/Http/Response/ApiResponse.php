<?php

namespace App\Http\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse extends JsonResponse
{
    public function __construct(array $data, int $status)
    {
        parent::__construct($data, $status);
    }
}