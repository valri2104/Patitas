<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory;

    /**
     * ORDER ITEM ATTRIBUTES
     * $this->attributes['id'] - int - order item primary key
     * $this->attributes['order_id'] - int - foreign key to orders table
     * $this->attributes['product_id'] - int - foreign key to products table
     * $this->attributes['quantity'] - int - quantity of the product in the order
     * $this->attributes['unitPrice'] - decimal - unit price of the product at the time of purchase
     * $this->attributes['created_at'] - timestamp - creation date
     * $this->attributes['updated_at'] - timestamp - last update date
     *
     * $this->order - Order - the order this item belongs to
     * $this->product - Product - the product this item represents
     */
    protected $fillable = ['order_id', 'product_id', 'quantity', 'unitPrice'];

    protected $casts = [
        'unitPrice' => 'float',
    ];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getOrderId(): int
    {
        return $this->attributes['order_id'];
    }

    public function setOrderId(int $orderId): void
    {
        $this->attributes['order_id'] = $orderId;
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function setProductId(int $productId): void
    {
        $this->attributes['product_id'] = $productId;
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function getUnitPrice(): float
    {
        return $this->attributes['unitPrice'];
    }

    public function setUnitPrice(float $unitPrice): void
    {
        $this->attributes['unitPrice'] = $unitPrice;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * Calculate the subtotal for this order item
     */
    public function calculateSubtotal(): float
    {
        return $this->getQuantity() * $this->getUnitPrice();
    }
}
