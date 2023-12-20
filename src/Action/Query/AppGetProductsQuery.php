<?php
namespace App\Action\Query;

use App\Action\AbstractAction;
use App\Repository\ProductRepository;
use App\Resources\AppGetProductsResource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;

class AppGetProductsQuery
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function fetch(RequestStack $requestStack,array $parameters = []): Response
    {
        return new Response(json_encode(AppGetProductsResource::get($this->productRepository->findAll())));
    }
}
