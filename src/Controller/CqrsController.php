<?php
/*
 * Author: Stefan Sander <mail@stefan-sander.online>
 */

namespace App\Controller;

use App\Cqrs\Command\CartSaveCommand;
use App\Cqrs\Command\CartSaveCommandHandler;
use App\Cqrs\Query\AppGetCardQuery;
use App\Cqrs\Query\AppGetCardQueryHandler;
use App\Cqrs\Query\AppGetProductsQuery;
use App\Cqrs\Query\AppGetProductsQueryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;


/**
 * @Route("/api", name="cartSave")
 */
class CqrsController extends AbstractController
{
    /**
     * @Route("/cartSave", name="cartSave")
     */
    public function cartSave(RequestStack $requestStack, CartSaveCommandHandler $handler): JsonResponse
    {
        $sessionId = $requestStack->getSession()->get('sessionId');
        $command = new CartSaveCommand(
            $sessionId,
            json_decode($requestStack->getCurrentRequest()->getContent(), true)['cart']
        );
        return new JsonResponse($handler->execute($requestStack, $command));
    }

    /**
     * @Route("/appGetProducts", name="AppGetProducts")
     */
    public function appGetProducts(RequestStack $requestStack, AppGetProductsQueryHandler $handler): Response
    {
        $query = new AppGetProductsQuery($requestStack->getSession()->get('sessionId'));
        return $handler->fetch($query);
    }

    /**
     * @Route("/appGetCard", name="appGetCard")
     */
    public function appGetCard(RequestStack $requestStack, AppGetCardQueryHandler $handler): JsonResponse
    {
        var_dump("A");
        $sessionId = $requestStack->getSession()->get('sessionId');
        var_dump($sessionId);
        $c = new AppGetCardQuery($sessionId);
        var_dump("B");
        return $handler->fetch($query);
    }
}