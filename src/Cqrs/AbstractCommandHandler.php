<?php
namespace App\Cqrs;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractCommandHandler
{
    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}