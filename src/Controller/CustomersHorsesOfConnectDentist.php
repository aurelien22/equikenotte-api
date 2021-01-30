<?php

namespace App\Controller;

use App\Entity\Dentist;
use App\Repository\HorseRepository;

class CustomersHorsesOfConnectDentist
{
    private HorseRepository $repository;

    public function __construct(HorseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Dentist $data)
    {
        return $this->repository->findHorsesByDentistId($data->getId());
    }
}
