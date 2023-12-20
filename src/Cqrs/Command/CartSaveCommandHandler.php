<?php
namespace App\Cqrs\Command;

use App\Cqrs\AbstractCommand;
use App\Cqrs\CommandHandlerInterface;
use App\Entity\Cart;
use App\Entity\CartProduct;
use App\Repository\CartRepository;
use App\Repository\CartProductRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CartSaveCommandHandler extends AbstractCommand implements CommandHandlerInterface
{
    private CartRepository $cartRepository;
    private CartProductRepository $cartProductRepository;
    private ProductRepository $productRepository;

    public function __construct(EntityManagerInterface $entityManager, CartRepository $cartRepository, CartProductRepository $cartProductRepository, ProductRepository $productRepository) {

        parent::__construct($entityManager);

        $this->cartRepository = $cartRepository;
        $this->cartProductRepository = $cartProductRepository;
        $this->productRepository = $productRepository;
    }

    public function execute(RequestStack $requestStack,CartSaveCommand $command): int
    {
        foreach($this->cartRepository->findBy(['sessionId' => $command->getSessionId()]) as $cart) {

            foreach($this->cartProductRepository->findBy(['cart' => $cart]) as $cartProduct) {
                $this->entityManager->remove($cartProduct);
            };

            $this->entityManager->remove($cart);
        };

        $cart = new Cart();
        $cart->setSessionId($command->getSessionId());
        $this->entityManager->persist($cart);

        foreach($command->getProducts() as $product) {
            $entity = $this->productRepository->find($product['id']);
            $cartProduct = new CartProduct();
            $cartProduct->setCart($cart);
            $cartProduct->setProduct($entity);
            $this->entityManager->persist($cartProduct);
        }
        $this->entityManager->persist($cart);
        $this->entityManager->persist($command);

        $this->entityManager->flush();
        return true;
    }
}
