<?php

declare(strict_types=1);

namespace YandexParser\DTO;

final readonly class Place
{
    /**
     * @param  string[]  $phones
     * @param  array<string, string>|null  $socialLinks
     * @param  string[]  $categories
     * @param  array<int, mixed>|null  $features
     * @param  array<string, mixed>|null  $schedule
     * @param  array<int, mixed>|null  $reviewAspects
     * @param  array<int, mixed>  $reviews
     * @param  array<int, mixed>  $photos
     * @param  array<int, mixed>|null  $nearbyMetro
     */
    public function __construct(
        public string $businessId,
        public string $title,
        public ?string $description,
        public ?string $type,
        public ?string $url,
        public ?float $longitude,
        public ?float $latitude,
        public ?string $address,
        public ?string $country,
        public ?string $region,
        public ?string $city,
        public ?string $street,
        public ?string $house,
        public ?string $postalCode,
        public ?string $status,
        public bool $isOpenNow,
        public bool $isVerifiedOwner,
        public ?string $workingHoursText,
        public ?array $schedule,
        public ?float $rating,
        public ?int $ratingsCount,
        public ?int $reviewCount,
        public array $phones,
        public ?string $website,
        public ?string $email,
        public ?array $socialLinks,
        public array $categories,
        public ?array $features,
        public ?string $chainName,
        public ?string $chainId,
        public ?string $logoUrl,
        public ?int $photoCount,
        public ?string $photoUrlTemplate,
        public ?string $neurosummary,
        public ?array $reviewAspects,
        public array $reviews,
        public array $photos,
        public ?array $nearbyMetro,
        public ?string $searchQuery,
        public ?string $snippet,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            businessId: (string) ($data['businessId'] ?? ''),
            title: (string) ($data['title'] ?? ''),
            description: $data['description'] ?? null,
            type: $data['type'] ?? null,
            url: $data['url'] ?? null,
            longitude: isset($data['longitude']) ? (float) $data['longitude'] : null,
            latitude: isset($data['latitude']) ? (float) $data['latitude'] : null,
            address: $data['address'] ?? null,
            country: $data['country'] ?? null,
            region: $data['region'] ?? null,
            city: $data['city'] ?? null,
            street: $data['street'] ?? null,
            house: $data['house'] ?? null,
            postalCode: $data['postalCode'] ?? null,
            status: $data['status'] ?? null,
            isOpenNow: $data['isOpenNow'] ?? false,
            isVerifiedOwner: $data['isVerifiedOwner'] ?? false,
            workingHoursText: $data['workingHoursText'] ?? null,
            schedule: $data['schedule'] ?? null,
            rating: isset($data['rating']) ? (float) $data['rating'] : null,
            ratingsCount: isset($data['ratingsCount']) ? (int) $data['ratingsCount'] : null,
            reviewCount: isset($data['reviewCount']) ? (int) $data['reviewCount'] : null,
            phones: $data['phones'] ?? [],
            website: $data['website'] ?? null,
            email: $data['email'] ?? null,
            socialLinks: $data['socialLinks'] ?? null,
            categories: $data['categories'] ?? [],
            features: $data['features'] ?? null,
            chainName: $data['chainName'] ?? null,
            chainId: $data['chainId'] ?? null,
            logoUrl: $data['logoUrl'] ?? null,
            photoCount: isset($data['photoCount']) ? (int) $data['photoCount'] : null,
            photoUrlTemplate: $data['photoUrlTemplate'] ?? null,
            neurosummary: $data['neurosummary'] ?? null,
            reviewAspects: $data['reviewAspects'] ?? null,
            reviews: $data['reviews'] ?? [],
            photos: $data['photos'] ?? [],
            nearbyMetro: $data['nearbyMetro'] ?? null,
            searchQuery: $data['searchQuery'] ?? null,
            snippet: $data['snippet'] ?? null,
        );
    }

    /**
     * Check if the place has any contact information (phones or email).
     */
    public function hasContactInfo(): bool
    {
        return count($this->phones) > 0 || ($this->email !== null && $this->email !== '');
    }

    /**
     * Get the first phone number, or null if none available.
     */
    public function getFirstPhone(): ?string
    {
        return $this->phones[0] ?? null;
    }

    /**
     * Check if the place has a website.
     */
    public function hasWebsite(): bool
    {
        return $this->website !== null && $this->website !== '';
    }

    /**
     * Get coordinates as an associative array, or null if not available.
     *
     * @return array{lng: float, lat: float}|null
     */
    public function getCoordinates(): ?array
    {
        if ($this->longitude === null || $this->latitude === null) {
            return null;
        }

        return ['lng' => $this->longitude, 'lat' => $this->latitude];
    }

    /**
     * Check if the place owner is verified.
     */
    public function isVerified(): bool
    {
        return $this->isVerifiedOwner;
    }
}
