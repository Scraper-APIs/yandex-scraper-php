<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
*/

// Uses default TestCase

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
*/

function getSamplePlaceData(): array
{
    return [
        'businessId' => '1124715036',
        'title' => 'Pushkin',
        'description' => 'Legendary restaurant of Russian cuisine in a historic mansion on Tverskoy Boulevard.',
        'type' => 'restaurant',
        'url' => 'https://yandex.ru/maps/org/pushkin/1124715036/',
        'longitude' => 37.600312,
        'latitude' => 55.764353,
        'address' => 'Tverskoy Boulevard, 26A, Moscow, Russia, 125009',
        'country' => 'Russia',
        'region' => 'Moscow',
        'city' => 'Moscow',
        'street' => 'Tverskoy Boulevard',
        'house' => '26A',
        'postalCode' => '125009',
        'status' => 'open',
        'isOpenNow' => true,
        'isVerifiedOwner' => true,
        'workingHoursText' => 'Daily, 12:00-00:00',
        'schedule' => [
            'Mon' => ['from' => '12:00', 'to' => '00:00'],
            'Tue' => ['from' => '12:00', 'to' => '00:00'],
        ],
        'rating' => 4.6,
        'ratingsCount' => 3150,
        'reviewCount' => 2847,
        'phones' => ['+74955992664', '+74959999870'],
        'website' => 'https://cafe-pushkin.ru',
        'email' => 'info@cafe-pushkin.ru',
        'socialLinks' => ['instagram' => 'cafe_pushkin', 'facebook' => 'cafepushkin'],
        'categories' => ['Restaurant', 'Banquet hall'],
        'features' => [
            ['name' => 'Wi-Fi', 'value' => true],
            ['name' => 'Card payment', 'value' => true],
        ],
        'chainName' => 'Maison Dellos',
        'chainId' => 'chain_001',
        'logoUrl' => 'https://avatars.mds.yandex.net/logo/pushkin.png',
        'photoCount' => 245,
        'photoUrlTemplate' => 'https://avatars.mds.yandex.net/get-altay/%s',
        'neurosummary' => 'Guests praise the exquisite Russian cuisine, elegant interior and attentive service.',
        'reviewAspects' => [
            ['aspect' => 'food', 'sentiment' => 'positive', 'count' => 1200],
            ['aspect' => 'service', 'sentiment' => 'positive', 'count' => 800],
        ],
        'reviews' => [
            ['reviewId' => 'r1', 'rating' => 5, 'text' => 'Amazing food and atmosphere'],
        ],
        'photos' => [
            ['url' => 'https://avatars.mds.yandex.net/photos/pushkin-1.jpg', 'category' => 'interior'],
        ],
        'nearbyMetro' => [
            ['name' => 'Pushkinskaya', 'distance' => 150, 'line' => 'Tagansko-Krasnopresnenskaya'],
        ],
        'searchQuery' => 'restaurant',
        'snippet' => 'Famous Russian cuisine restaurant',
    ];
}

function getSampleReviewData(): array
{
    return [
        'reviewId' => 'rev_abc123def456',
        'businessId' => '1124715036',
        'businessTitle' => 'Pushkin',
        'businessUrl' => 'https://yandex.ru/maps/org/pushkin/1124715036/',
        'businessAddress' => 'Tverskoy Boulevard, 26A',
        'businessCity' => 'Moscow',
        'businessRating' => 4.6,
        'businessRatingsCount' => 3150,
        'businessCategories' => ['Restaurant', 'Banquet hall'],
        'rating' => 5,
        'text' => 'Excellent restaurant with stunning interior. The borsch was outstanding and the service was impeccable.',
        'date' => '2026-01-20T18:30:00Z',
        'authorName' => 'Alexei Petrov',
        'authorId' => 'user_789012',
        'authorAvatarUrl' => 'https://avatars.mds.yandex.net/avatars/user789.jpg',
        'authorProfileUrl' => 'https://yandex.ru/maps/profile/user_789012',
        'authorLevel' => 'Expert',
        'likeCount' => 12,
        'dislikeCount' => 1,
        'businessComment' => 'Thank you for your kind words, Alexei! We are glad you enjoyed your visit.',
        'businessCommentDate' => '2026-01-21T10:00:00Z',
        'neurosummary' => 'The reviewer highly praised the food quality and atmosphere.',
        'photos' => [
            'https://avatars.mds.yandex.net/reviews/photo1.jpg',
            'https://avatars.mds.yandex.net/reviews/photo2.jpg',
        ],
        'videos' => [
            'https://avatars.mds.yandex.net/reviews/video1.mp4',
        ],
        'keyPhrases' => [
            ['phrase' => 'stunning interior', 'sentiment' => 'positive'],
            ['phrase' => 'outstanding borsch', 'sentiment' => 'positive'],
        ],
        'isAnonymous' => false,
    ];
}

function getSampleProductData(): array
{
    return [
        'title' => 'ASUS VivoBook 15 X1504VA-BQ613',
        'modelId' => 1971655847,
        'marketSku' => '101946073291',
        'productUrl' => 'https://market.yandex.ru/product--asus-vivobook-15/1971655847',
        'price' => 54990.0,
        'currency' => 'RUB',
        'priceYaBank' => 49491.0,
        'rating' => 4.7,
        'ratingCount' => 856,
        'reviewCount' => 234,
        'purchaseCount' => 5600,
        'brand' => 'ASUS',
        'categoryName' => 'Laptops',
        'description' => 'Laptop ASUS VivoBook 15 with Intel Core i5, 16GB RAM, 512GB SSD, 15.6" FHD display.',
        'specifications' => [
            ['name' => 'Processor', 'value' => 'Intel Core i5-1335U'],
            ['name' => 'RAM', 'value' => '16 GB'],
            ['name' => 'Storage', 'value' => '512 GB SSD'],
        ],
        'isAvailable' => true,
        'stockCount' => 42,
        'sellerName' => 'TechStore',
        'sellerRating' => 4.8,
        'sellerRatingCount' => 12500,
        'sellerLogo' => 'https://avatars.mds.yandex.net/sellers/techstore.png',
        'businessId' => 987654,
        'shopId' => 123456,
        'images' => [
            'https://avatars.mds.yandex.net/products/asus-1.jpg',
            'https://avatars.mds.yandex.net/products/asus-2.jpg',
            'https://avatars.mds.yandex.net/products/asus-3.jpg',
        ],
        'reviews' => [
            ['rating' => 5, 'text' => 'Great laptop for the price'],
        ],
        'ratingDistribution' => ['5' => 450, '4' => 250, '3' => 100, '2' => 36, '1' => 20],
        'breadcrumbs' => [
            ['name' => 'Electronics', 'url' => '/catalog/electronics'],
            ['name' => 'Laptops', 'url' => '/catalog/laptops'],
        ],
        'isExpress' => true,
        'isBnpl' => true,
        'sponsored' => false,
        'searchPosition' => 3,
        'scrapedAt' => '2026-02-15T14:22:00Z',
    ];
}
