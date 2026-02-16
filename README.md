# Yandex Scraper PHP

**English** | [Русский](https://github.com/Scraper-APIs/yandex-parser-php)

A PHP client library for scraping data from [Yandex](https://yandex.ru) services -- extract places and businesses from Yandex Maps, reviews from Yandex Maps, and products from Yandex Market (Russia's largest marketplace). Returns typed DTOs for each data type.

Powered by [Apify](https://apify.com/) actors under the hood.

## Installation

```bash
composer require scraper-apis/yandex-parser
```

## Quick Start

```php
use YandexParser\Client;

$client = new Client('your_apify_api_token');

// Search for restaurants in Moscow
$places = $client->scrapePlaces(
    query: ['restaurant'],
    location: 'Moscow',
    maxResults: 50,
);

foreach ($places as $place) {
    echo "{$place->title} — {$place->address}\n";
    echo "Rating: {$place->rating} ({$place->reviewCount} reviews)\n";

    if ($place->hasContactInfo()) {
        echo "Phone: {$place->getFirstPhone()}\n";
        echo "Email: {$place->email}\n";
    }

    if ($place->hasWebsite()) {
        echo "Website: {$place->website}\n";
    }
}
```

## Available Methods

The client wraps 3 specialized Apify actors, each optimized for a specific Yandex service.

### 1. Places / Businesses (Yandex Maps)

Search Yandex Maps by keyword and location. Returns rich records with 40+ fields including contacts, ratings, schedule, photos, AI-generated summaries, and more.

```php
use YandexParser\Language;

$places = $client->scrapePlaces(
    query: ['dentist', 'dental clinic'],
    location: 'Saint Petersburg',
    maxResults: 200,
    language: Language::Russian,
    options: [
        'filterRating' => 4.5,
        'filterOpenNow' => true,
        'filterCardPayment' => true,
        'enrichBusinessData' => true,
        'maxPhotos' => 5,
    ],
);
```

**Available options for `scrapePlaces()`:**

| Option | Type | Description |
|--------|------|-------------|
| `filterRating` | `float` | Minimum rating threshold |
| `filterOpenNow` | `bool` | Only currently open places |
| `filterOpen24h` | `bool` | Only 24/7 places |
| `filterDelivery` | `bool` | Has delivery service |
| `filterTakeaway` | `bool` | Has takeaway option |
| `filterWifi` | `bool` | WiFi available |
| `filterCardPayment` | `bool` | Accepts card payments |
| `filterParking` | `bool` | Has parking |
| `filterPetFriendly` | `bool` | Pet-friendly establishment |
| `filterWheelchairAccess` | `bool` | Wheelchair accessible |
| `filterGoodPlace` | `bool` | Yandex "Good Place" badge |
| `filterMichelin` | `bool` | Michelin-rated |
| `filterBusinessLunch` | `bool` | Offers business lunch |
| `filterSummerTerrace` | `bool` | Has summer terrace |
| `filterCuisine` | `string` | Filter by cuisine type |
| `filterPriceCategory` | `string` | Price category filter |
| `filterPriceMin` | `int` | Minimum average check |
| `filterPriceMax` | `int` | Maximum average check |
| `filterCategoryId` | `string` | Filter by category ID |
| `filterChainId` | `string` | Filter by chain ID |
| `customFilters` | `array` | Custom filter parameters |
| `sortBy` | `string` | Sort results |
| `sortOrigin` | `string` | Sort origin point |
| `enrichBusinessData` | `bool` | Fetch detailed business data |
| `maxPhotos` | `int` | Max photos per place |
| `maxPosts` | `int` | Max posts per place |
| `startUrls` | `string[]` | Direct Yandex Maps URLs |
| `businessIds` | `string[]` | Direct business IDs |
| `coordinates` | `string` | Search center coordinates |
| `viewportSpan` | `string` | Map viewport span |
| `category` | `string` | Category filter |

**Place DTO helpers:**

```php
$place->hasContactInfo();    // true if phones or email exist
$place->getFirstPhone();     // first phone number or null
$place->hasWebsite();        // true if website is set
$place->getCoordinates();    // ['lng' => float, 'lat' => float] or null
$place->isVerified();        // true if owner is verified
```

### 2. Reviews (Yandex Maps)

Extract reviews from Yandex Maps businesses. Accepts business URLs or numeric IDs. Returns flat one-row-per-review records with author info, business reply, and AI analysis.

```php
use YandexParser\ReviewSort;
use YandexParser\Language;

$reviews = $client->scrapeReviews(
    startUrls: [
        'https://yandex.ru/maps/org/pushkin/1124715036/',
    ],
    maxReviewsPerPlace: 500,
    reviewSort: ReviewSort::Newest,
    minRating: 1,
    maxRating: 3,
    language: Language::Russian,
);

foreach ($reviews as $review) {
    echo "{$review->authorName}: {$review->rating}/5\n";
    echo "{$review->text}\n";

    if ($review->hasBusinessReply()) {
        echo "Reply: {$review->getBusinessReplyText()}\n";
    }

    if ($review->hasPhotos()) {
        echo "Photos: " . count($review->photos) . "\n";
    }
}
```

**Parameters for `scrapeReviews()`:**

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `startUrls` | `string[]` | `[]` | Yandex Maps business URLs |
| `businessIds` | `string[]` | `[]` | Direct numeric business IDs |
| `maxReviewsPerPlace` | `int` | `0` | Max reviews per place (0 = all) |
| `reviewSort` | `ReviewSort` | `Relevance` | Sort order |
| `minRating` | `int` | `0` | Minimum star rating filter |
| `maxRating` | `int` | `0` | Maximum star rating filter |
| `language` | `Language` | `English` | Response language |

At least one of `startUrls` or `businessIds` must be provided; otherwise an `ApiException` is thrown.

**Review DTO helpers:**

```php
$review->hasBusinessReply();      // true if business replied
$review->getBusinessReplyText();  // reply text or null
$review->hasPhotos();             // true if review has photos
$review->hasVideos();             // true if review has videos
$review->isPositive();            // true if rating >= 4
$review->isNegative();            // true if rating <= 2
```

### 3. Products (Yandex Market)

Scrape product listings from Yandex Market -- Russia's largest e-commerce marketplace. Returns detailed product data with pricing, seller info, specifications, stock status, and YaBank card discounts.

```php
use YandexParser\MarketSort;
use YandexParser\MarketRegion;

$products = $client->scrapeProducts(
    query: 'ASUS laptop',
    maxItems: 50,
    region: MarketRegion::Moscow,
    sort: MarketSort::PriceAsc,
    options: [
        'priceFrom' => 30000,
        'priceTo' => 80000,
        'includeReviews' => true,
    ],
);

foreach ($products as $product) {
    echo "{$product->title}\n";
    echo "Price: {$product->getPriceFormatted()}\n";
    echo "Seller: {$product->sellerName} (rating: {$product->sellerRating})\n";

    $discount = $product->getYaBankDiscount();
    if ($discount !== null) {
        echo "YaBank discount: {$discount}%\n";
    }

    if ($product->isInStock()) {
        echo "In stock: {$product->stockCount} units\n";
    }
}
```

**Available options for `scrapeProducts()`:**

| Option | Type | Description |
|--------|------|-------------|
| `priceFrom` | `int` | Minimum price filter |
| `priceTo` | `int` | Maximum price filter |
| `categoryId` | `string` | Filter by category |
| `enrichProducts` | `bool` | Fetch detailed product data |
| `includeReviews` | `bool` | Include product reviews |
| `proxyUrl` | `string` | Custom proxy URL |

**Product DTO helpers:**

```php
$product->hasReviews();         // true if reviews array is not empty
$product->hasImages();          // true if images array is not empty
$product->isInStock();          // true if product is available
$product->getPriceFormatted();  // "54,990 RUB" or null
$product->getYaBankDiscount();  // percentage discount (e.g. 10.0) or null
```

## Enums Reference

### Language

Supported across places and reviews actors. 6 languages covering the Yandex Maps service area.

| Case | Value | Language |
|------|-------|----------|
| `Auto` | `auto` | Auto-detect |
| `Russian` | `ru` | Russian |
| `English` | `en` | English |
| `Turkish` | `tr` | Turkish |
| `Ukrainian` | `uk` | Ukrainian |
| `Kazakh` | `kk` | Kazakh |

### ReviewSort

| Case | Value | Description |
|------|-------|-------------|
| `Relevance` | `relevance` | Most relevant first |
| `Newest` | `newest` | Newest first |
| `Highest` | `highest` | Highest rating first |
| `Lowest` | `lowest` | Lowest rating first |

### MarketSort

| Case | Value | Description |
|------|-------|-------------|
| `Default` | *(none)* | Default sorting |
| `Popular` | `dpop` | Most popular first |
| `PriceAsc` | `aprice` | Lowest price first |
| `PriceDesc` | `dprice` | Highest price first |
| `Rating` | `rating` | Highest rating first |

### MarketRegion

16 major Russian cities with their Yandex region IDs.

| Case | Value | City |
|------|-------|------|
| `Moscow` | `213` | Moscow |
| `SaintPetersburg` | `2` | Saint Petersburg |
| `Yekaterinburg` | `54` | Yekaterinburg |
| `Kazan` | `43` | Kazan |
| `Novosibirsk` | `65` | Novosibirsk |
| `NizhnyNovgorod` | `69` | Nizhny Novgorod |
| `Samara` | `51` | Samara |
| `RostovOnDon` | `39` | Rostov-on-Don |
| `Krasnodar` | `35` | Krasnodar |
| `Chelyabinsk` | `56` | Chelyabinsk |
| `Ufa` | `61` | Ufa |
| `Perm` | `47` | Perm |
| `Voronezh` | `62` | Voronezh |
| `Volgograd` | `63` | Volgograd |
| `Krasnoyarsk` | `66` | Krasnoyarsk |
| `Omsk` | `68` | Omsk |

## Configuration

```php
use YandexParser\Client;
use YandexParser\Config;

// Simple — just pass the API token
$client = new Client('your_apify_api_token');

// Advanced — override timeout or base URL
$client = new Client('token', new Config(
    apiToken: 'token',
    baseUrl: 'https://api.apify.com/v2',
    timeout: 600,
));
```

## Error Handling

```php
use YandexParser\Exception\ApiException;
use YandexParser\Exception\RateLimitException;

try {
    $places = $client->scrapePlaces(query: ['cafe'], location: 'Kazan');
} catch (RateLimitException $e) {
    // Retry after the suggested delay
    sleep($e->retryAfter);
} catch (ApiException $e) {
    echo "API error: {$e->getMessage()}\n";
}
```

## Requirements

- PHP 8.3+
- [Apify API token](https://console.apify.com/account/integrations)

## See Also

- [2GIS Scraper PHP](https://github.com/Scraper-APIs/2gis-scraper-php) — scrape 2GIS (places, reviews, real estate, jobs)

## License

MIT
