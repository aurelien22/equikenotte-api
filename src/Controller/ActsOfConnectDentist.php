<?php

namespace App\Controller;

use App\Entity\Dentist;
use App\Repository\ActRepository;

class ActsOfConnectDentist
{
    private ActRepository $repository;

    public function __construct(ActRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Dentist $data)
    {
        return $this->repository->findActsByDentistId($data->getId());
    }
}
