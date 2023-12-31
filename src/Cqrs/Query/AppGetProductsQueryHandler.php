<?php
/*
 * Author: Stefan Sander <mail@stefan-sander.online>
 */

namespace App\Cqrs\Query;

use App\Cqrs\AbstractQueryHandler;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;

class AppGetProductsQueryHandler extends AbstractQueryHandler
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function fetch(AppGetProductsQuery $command, AppGetProductsResource $resource): Response
    {
        return new Response(json_encode($resource->get($this->productRepository->findAll())));
    }
}
