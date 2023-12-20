<?php

namespace App\Cqrs\Query;

use App\Cqrs\AbstractQueryHandler;
use App\Repository\ProductRepository;
use App\Resources\AppGetProductsResource;
use Symfony\Component\HttpFoundation\Response;

class AppGetProductsQueryHandler extends AbstractQueryHandler
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function fetch(AppGetProductsQuery $command): Response
    {
        return new Response(json_encode(AppGetProductsResource::get($this->productRepository->findAll())));
    }
}
