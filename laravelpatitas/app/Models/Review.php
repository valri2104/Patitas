<?php

/**
 * Developed by: Valeria Cardona
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    /**
     * REVIEW ATTRIBUTES
     * $this->attributes['id'] - int - contains the review ID
     * $this->attributes['user_id'] - int - contains the foreign key (user_id) from users table
     * $this->attributes['product_id'] - int - contains the foreign key (product_id) from products table
     * $this->attributes['qualification'] - int - contains the review qualification
     * $this->attributes['description'] - string - contains the review description
     * $this->attributes['created_at'] - Carbon - contains the date when review was created
     * $this->attributes['updated_at'] - Carbon - contains the date when the review was updated
     *
     * $this->user - User - user that made the review
     * $this->product - Product - product that belongs the review
     */
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = ['user_id', 'product_id', 'qualification', 'description'];

    public $timestamps = true;

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function setProductId(int $productId): void
    {
        $this->attributes['product_id'] = $productId;
    }

    public function setQualification(int $qualification): void
    {
        $this->attributes['qualification'] = $qualification;
    }

    public function getQualification(): int
    {
        return $this->attributes['qualification'];
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getCreatedAt(): Carbon
    {
        return Carbon::parse($this->attributes['created_at']);
    }

    public function getUpdatedAt(): Carbon
    {
        return Carbon::parse($this->attributes['updated_at']);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public static function averageForProduct(int $productId): float
    {
        $average = self::where('product_id', $productId)->avg('qualification');

        return round((float) ($average ?? 0), 1);
    }

    public static function countForProduct(int $productId): int
    {
        return self::where('product_id', $productId)->count();
    }

    public function getStars(): string
    {
        $rating      = max(0, min(5, $this->getQualification()));
        $filledStars = str_repeat('★', $rating);
        $emptyStars  = str_repeat('☆', 5 - $rating);

        return $filledStars . $emptyStars;
    }

    public function isOwnedBy(int $userId): bool
    {
        return $this->getUserId() === $userId;
    }
}
