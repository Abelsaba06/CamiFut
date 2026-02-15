<?php
namespace App\Service;

use App\Entity\Camiseta;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;

class CarretService
{
    private const KEY = '_cart';
    private $requestStack;
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }
    public function getSession()
    {
        return $this->requestStack->getSession();
    }
    public function getCart(): array
    {
        return $this->getSession()->get(self::KEY, []);
    }
    public function add(int $id, int $quantity = 1, string $size = '', string $personalization = '', string $patches = '')
    {
        $cart = $this->getCart();

        // Create a unique key for this combination of product + options
        $uniqueKey = md5($id . $size . $personalization . $patches);

        if (!array_key_exists($uniqueKey, $cart)) {
            $cart[$uniqueKey] = [
                'id' => $id,
                'quantity' => 0,
                'size' => $size,
                'personalization' => $personalization,
                'patches' => $patches
            ];
        }

        $cart[$uniqueKey]['quantity'] += $quantity;

        $this->getSession()->set(self::KEY, $cart);
    }

    public function remove(string $uniqueKey)
    {
        $cart = $this->getCart();
        unset($cart[$uniqueKey]);
        $this->getSession()->set(self::KEY, $cart);
    }
}
