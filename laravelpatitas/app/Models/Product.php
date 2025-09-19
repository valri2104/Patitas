<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * PRODUCT ATTRIBUTES
     * $this->attributes['id'] - int - product primary key
     * $this->attributes['name'] - string - product name
     * $this->attributes['description'] - string - product description
     * $this->attributes['price'] - decimal - product price
     * $this->attributes['stock'] - int - product stock quantity
     * $this->attributes['category'] - string - product category (Alimento, Juguetes, Medicina, Accesorios)
     * $this->attributes['customizable'] - boolean - whether the product can be customized
     * $this->attributes['imageUrl'] - string - product image URL
     * $this->attributes['created_at'] - timestamp - creation date
     * $this->attributes['updated_at'] - timestamp - last update date
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category',
        'customizable',
        'imageUrl',
    ];

    protected $casts = [
        'customizable' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getPrice(): float
    {
        return $this->attributes['price'];
    }

    public function setPrice(float $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getStock(): int
    {
        return $this->attributes['stock'];
    }

    public function setStock(int $stock): void
    {
        $this->attributes['stock'] = $stock;
    }

    public function getCategory(): string
    {
        return $this->attributes['category'];
    }

    public function setCategory(string $category): void
    {
        $this->attributes['category'] = $category;
    }

    public function getCustomizable(): bool
    {
        return $this->attributes['customizable'];
    }

    public function setCustomizable(bool $customizable): void
    {
        $this->attributes['customizable'] = $customizable;
    }

    public function getImageUrl(): string
    {
        return $this->attributes['imageUrl'];
    }

    public function setImageUrl(string $imageUrl): void
    {
        $this->attributes['imageUrl'] = $imageUrl;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function isInStock(): bool
    {
        return $this->getStock() > 0;
    }

    public function decreaseStock(int $quantity): void
    {
        $currentStock = $this->getStock();
        if ($currentStock >= $quantity) {
            $this->setStock($currentStock - $quantity);
        }
    }

    public function increaseStock(int $quantity): void
    {
        $currentStock = $this->getStock();
        $this->setStock($currentStock + $quantity);
    }
}
