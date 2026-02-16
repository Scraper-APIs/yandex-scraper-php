<?php

declare(strict_types=1);

namespace YandexParser\DTO;

final readonly class Product
{
    /**
     * @param  array<int, mixed>|null  $specifications
     * @param  string[]  $images
     * @param  array<int, mixed>  $reviews
     * @param  array<string, int>|null  $ratingDistribution
     * @param  array<int, mixed>|null  $breadcrumbs
     */
    public function __construct(
        public ?string $title,
        public ?int $modelId,
        public ?string $marketSku,
        public ?string $productUrl,
        public ?float $price,
        public ?string $currency,
        public ?float $priceYaBank,
        public ?float $rating,
        public ?int $ratingCount,
        public ?int $reviewCount,
        public ?int $purchaseCount,
        public ?string $brand,
        public ?string $categoryName,
        public ?string $description,
        public ?array $specifications,
        public bool $isAvailable,
        public ?int $stockCount,
        public ?string $sellerName,
        public ?float $sellerRating,
        public ?int $sellerRatingCount,
        public ?string $sellerLogo,
        public ?int $businessId,
        public ?int $shopId,
        public array $images,
        public array $reviews,
        public ?array $ratingDistribution,
        public ?array $breadcrumbs,
        public bool $isExpress,
        public bool $isBnpl,
        public bool $sponsored,
        public ?int $searchPosition,
        public ?string $scrapedAt,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'] ?? null,
            modelId: isset($data['modelId']) ? (int) $data['modelId'] : null,
            marketSku: $data['marketSku'] ?? null,
            productUrl: $data['productUrl'] ?? null,
            price: isset($data['price']) ? (float) $data['price'] : null,
            currency: $data['currency'] ?? null,
            priceYaBank: isset($data['priceYaBank']) ? (float) $data['priceYaBank'] : null,
            rating: isset($data['rating']) ? (float) $data['rating'] : null,
            ratingCount: isset($data['ratingCount']) ? (int) $data['ratingCount'] : null,
            reviewCount: isset($data['reviewCount']) ? (int) $data['reviewCount'] : null,
            purchaseCount: isset($data['purchaseCount']) ? (int) $data['purchaseCount'] : null,
            brand: $data['brand'] ?? null,
            categoryName: $data['categoryName'] ?? null,
            description: $data['description'] ?? null,
            specifications: $data['specifications'] ?? null,
            isAvailable: $data['isAvailable'] ?? false,
            stockCount: isset($data['stockCount']) ? (int) $data['stockCount'] : null,
            sellerName: $data['sellerName'] ?? null,
            sellerRating: isset($data['sellerRating']) ? (float) $data['sellerRating'] : null,
            sellerRatingCount: isset($data['sellerRatingCount']) ? (int) $data['sellerRatingCount'] : null,
            sellerLogo: $data['sellerLogo'] ?? null,
            businessId: isset($data['businessId']) ? (int) $data['businessId'] : null,
            shopId: isset($data['shopId']) ? (int) $data['shopId'] : null,
            images: $data['images'] ?? [],
            reviews: $data['reviews'] ?? [],
            ratingDistribution: $data['ratingDistribution'] ?? null,
            breadcrumbs: $data['breadcrumbs'] ?? null,
            isExpress: $data['isExpress'] ?? false,
            isBnpl: $data['isBnpl'] ?? false,
            sponsored: $data['sponsored'] ?? false,
            searchPosition: isset($data['searchPosition']) ? (int) $data['searchPosition'] : null,
            scrapedAt: $data['scrapedAt'] ?? null,
        );
    }

    /**
     * Check if the product has reviews.
     */
    public function hasReviews(): bool
    {
        return count($this->reviews) > 0;
    }

    /**
     * Check if the product has images.
     */
    public function hasImages(): bool
    {
        return count($this->images) > 0;
    }

    /**
     * Check if the product is in stock.
     */
    public function isInStock(): bool
    {
        return $this->isAvailable;
    }

    /**
     * Get price formatted with currency, or null if not available.
     */
    public function getPriceFormatted(): ?string
    {
        if ($this->price === null) {
            return null;
        }

        $formatted = number_format($this->price, 0, '.', ',');

        return $this->currency !== null ? "{$formatted} {$this->currency}" : $formatted;
    }

    /**
     * Get the percentage discount when paying with YaBank card, or null if not available.
     */
    public function getYaBankDiscount(): ?float
    {
        if ($this->price === null || $this->priceYaBank === null || $this->price <= 0) {
            return null;
        }

        return round((1 - $this->priceYaBank / $this->price) * 100, 1);
    }
}
