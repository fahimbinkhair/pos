<?php
/**
 * act as data source as we we do not have database installed for this app
 *
 * @package App\Data
 */
declare(strict_types=1);

namespace App\Data;

/**
 * Class Product
 * @package App\Data
 */
class Product
{
    /** @var array PRODUCT */
    private const PRODUCTS = [
        'ZA' => [
            'unitPrice' => 2.00,
            'offer' => [
                'volumeSize' => 4,
                'volumePrice' => 7.00
            ]
        ],
        'YB' => [
            'unitPrice' => 12.00
        ],
        'FC' => [
            'unitPrice' => 1.25,
            'offer' => [
                'volumeSize' => 6,
                'volumePrice' => 6.00
            ]
        ],
        'GD' => [
            'unitPrice' => 0.15
        ]
    ];

    /**
     * return the requested product
     * @param string $productCode
     * @return array|null
     */
    public function getProduct(string $productCode): ?array
    {
        if (array_key_exists($productCode, self::PRODUCTS)) {
            return self::PRODUCTS[$productCode];
        }

        return null;
    }
}
