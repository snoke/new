<?php
namespace App\Cqrs\Query;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

interface QueryInterface {
    public function fetch(RequestStack $request): JsonResponse;
}