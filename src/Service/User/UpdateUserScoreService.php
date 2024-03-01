<?php 

namespace App\Service\User;

use App\Repository\User\DoctrineUserRepository;

class UpdateUserScoreService
{
    public function __construct(
        private DoctrineUserRepository $userRepo
    ) {
        
    }

    public function __invoke(): void
    {
        // SIN USAR BATCHES
        // $users = $this->userRepo->all();

        // foreach ($users as $user) {
        //     $user->updateScore();

        //     $this->userRepo->save($user);
        // }

        // USANDO BATCHES
        $this->userRepo->updateAllWithIterable();
        
    }
    
}