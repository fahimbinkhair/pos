<?php
/**
 * populate the shopping basket
 *
 * @package App\Services
 */
declare(strict_types=1);

namespace App\Services;

use App\Data\Product;

/**
 * Class Terminal
 * @package App\Services
 */
class Terminal extends ServiceBase
{
    /** @var Product $product */
    private $product;

    /** @var array $scannedItems */
    private $scannedItems = [];

    /**
     * Terminal constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->product = new Product();
    }

    /**
     * add each scanned item in the cart
     * @param string $productCode
     * @throws \Exception
     */
    public function scanItem(string $productCode): void
    {
        /** @var array|null $productInfo */
        $productInfo = $this->product->getProduct($productCode);

        if ($productInfo === null) {
            $message = "Can not find the product '{$productCode}'";
            $this->logger->setMessage($message, __FILE__, __LINE__)->log()->throwException();
        }

        if (!array_key_exists($productCode, $this->scannedItems)) {
            $this->scannedItems[$productCode]['quantity'] = 1;
        } else {
            $this->scannedItems[$productCode]['quantity']++;
        }

        $this->scannedItems[$productCode]['price'] = $this->calculateProductPrice(
            $this->scannedItems[$productCode]['quantity'],
            $productInfo
        );
    }

    /**
     * calculate the total price for the currently scanned item
     * @param int $quantity
     * @param array $productInfo
     * @return float
     */
    private function calculateProductPrice(int $quantity, array $productInfo): float
    {
        if (!array_key_exists('offer', $productInfo)) {
            return (float)$productInfo['unitPrice'] * $quantity;
        }

        /** @var int $offerVolumeSize */
        $offerVolumeSize = $productInfo['offer']['volumeSize'];

        if ($quantity < $offerVolumeSize) {
            return (float)$productInfo['unitPrice'] * $quantity;
        }

        /** @var float $offerVolumePrice */
        $offerVolumePrice = $productInfo['offer']['volumePrice'];
        /** @var int $remainder */
        $remainder = $quantity % $offerVolumeSize;
        /** @var int $quotient */
        $quotient = ($quantity - $remainder) / $offerVolumeSize;

        return floatval(($quotient * $offerVolumePrice) + ($remainder * $productInfo['unitPrice']));
    }

    /**
     * get total value of the scanned products
     * @return float
     */
    public function getTotal(): float
    {
        return (float)array_sum(array_column($this->scannedItems, 'price'));
    }
}
