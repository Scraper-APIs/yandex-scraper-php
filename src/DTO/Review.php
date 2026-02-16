<?php

declare(strict_types=1);

namespace YandexParser\DTO;

final readonly class Review
{
    /**
     * @param  string[]  $businessCategories
     * @param  string[]  $photos
     * @param  string[]  $videos
     * @param  array<int, mixed>|null  $keyPhrases
     */
    public function __construct(
        public string $reviewId,
        public string $businessId,
        public ?string $businessTitle,
        public ?string $businessUrl,
        public ?string $businessAddress,
        public ?string $businessCity,
        public ?float $businessRating,
        public ?int $businessRatingsCount,
        public array $businessCategories,
        public int $rating,
        public ?string $text,
        public ?string $date,
        public ?string $authorName,
        public ?string $authorId,
        public ?string $authorAvatarUrl,
        public ?string $authorProfileUrl,
        public ?string $authorLevel,
        public ?int $likeCount,
        public ?int $dislikeCount,
        public ?string $businessComment,
        public ?string $businessCommentDate,
        public ?string $neurosummary,
        public array $photos,
        public array $videos,
        public ?array $keyPhrases,
        public bool $isAnonymous,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            reviewId: (string) ($data['reviewId'] ?? ''),
            businessId: (string) ($data['businessId'] ?? ''),
            businessTitle: $data['businessTitle'] ?? null,
            businessUrl: $data['businessUrl'] ?? null,
            businessAddress: $data['businessAddress'] ?? null,
            businessCity: $data['businessCity'] ?? null,
            businessRating: isset($data['businessRating']) ? (float) $data['businessRating'] : null,
            businessRatingsCount: isset($data['businessRatingsCount']) ? (int) $data['businessRatingsCount'] : null,
            businessCategories: $data['businessCategories'] ?? [],
            rating: (int) ($data['rating'] ?? 0),
            text: $data['text'] ?? null,
            date: $data['date'] ?? null,
            authorName: $data['authorName'] ?? null,
            authorId: $data['authorId'] ?? null,
            authorAvatarUrl: $data['authorAvatarUrl'] ?? null,
            authorProfileUrl: $data['authorProfileUrl'] ?? null,
            authorLevel: $data['authorLevel'] ?? null,
            likeCount: isset($data['likeCount']) ? (int) $data['likeCount'] : null,
            dislikeCount: isset($data['dislikeCount']) ? (int) $data['dislikeCount'] : null,
            businessComment: $data['businessComment'] ?? null,
            businessCommentDate: $data['businessCommentDate'] ?? null,
            neurosummary: $data['neurosummary'] ?? null,
            photos: $data['photos'] ?? [],
            videos: $data['videos'] ?? [],
            keyPhrases: $data['keyPhrases'] ?? null,
            isAnonymous: $data['isAnonymous'] ?? false,
        );
    }

    /**
     * Check if the business has replied to this review.
     */
    public function hasBusinessReply(): bool
    {
        return $this->businessComment !== null && $this->businessComment !== '';
    }

    /**
     * Get the business reply text, or null if none.
     */
    public function getBusinessReplyText(): ?string
    {
        if (! $this->hasBusinessReply()) {
            return null;
        }

        return $this->businessComment;
    }

    /**
     * Check if the review has attached photos.
     */
    public function hasPhotos(): bool
    {
        return count($this->photos) > 0;
    }

    /**
     * Check if the review has attached videos.
     */
    public function hasVideos(): bool
    {
        return count($this->videos) > 0;
    }

    /**
     * Check if the review is positive (4-5 stars).
     */
    public function isPositive(): bool
    {
        return $this->rating >= 4;
    }

    /**
     * Check if the review is negative (1-2 stars).
     */
    public function isNegative(): bool
    {
        return $this->rating <= 2;
    }
}
