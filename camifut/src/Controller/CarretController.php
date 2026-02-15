<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\CarretService;
use App\Entity\Camiseta;
use Symfony\Component\HttpFoundation\Request;

final class CarretController extends AbstractController
{
    private $doctrine;
    private $repository;
    private $cart;
    public function __construct(ManagerRegistry $doctrine, CarretService $cart)
    {
        $this->doctrine = $doctrine;
        $this->repository = $doctrine->getRepository(Camiseta::class);
        $this->cart = $cart;
    }
    #[Route('/cart', name: 'app_cart')]
    public function index(): Response
    {
        $cart = $this->cart->getCart();
        $cartItems = [];
        $total = 0;

        foreach ($cart as $key => $item) {
            $product = $this->repository->find($item['id']);
            if ($product) {
                $itemTotal = $product->getPrecio() * $item['quantity'];
                $total += $itemTotal;

                $cartItems[] = [
                    'key' => $key,
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'size' => $item['size'],
                    'personalization' => $item['personalization'],
                    'patches' => $item['patches'],
                    'total' => $itemTotal
                ];
            }
        }

        return $this->render('cart/index.html.twig', [
            'items' => $cartItems,
            'total' => $total
        ]);
    }
    #[Route('/cart/add/{id}', name: 'cart_add', methods: ['POST', 'GET'])]
    public function cart_add(int $id, Request $request): Response
    {
        $product = $this->repository->find($id);
        if (!$product)
            return new JsonResponse(["error" => "Product not found"], Response::HTTP_NOT_FOUND);

        $quantity = $request->query->getInt('quantity', 1);
        $size = $request->query->get('size', '');
        $personalization = $request->query->get('personalization', '');
        $patches = $request->query->get('patches', '');

        $this->cart->add($id, $quantity, $size, $personalization, $patches);

        // Return the full cart or just success. For now, sending the updated cart count for this item type might be complex due to the key.
        // Let's just return success and the total cart dump for debugging if needed, or just a success message.
        return new JsonResponse(["status" => "success", "message" => "Added to cart"], Response::HTTP_OK);
    }
    #[Route('/cart/remove/{id}', name: 'cart_remove', methods: ['POST', 'GET'])]
    public function cart_remove(string $id): Response
    {
        $this->cart->remove($id);
        // If we want to stay on the page, instead of JSON response, we should redirect to cart index.
        return $this->redirectToRoute('app_cart');
    }
    #[Route('/cart/update/{id}', name: 'cart_update', methods: ['POST', 'GET'])]
    public function cart_update(string $id, Request $request): Response
    {
        $quantity = $request->query->getInt('quantity', 1);
        $this->cart->update($id, $quantity);
        return $this->redirectToRoute('app_cart');
    }
}
