<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * ORDER ITEM ATTRIBUTES
 * $this->attributes['id'] - int - order item primary key
 * $this->attributes['orderId'] - int - order foreign key
 * $this->attributes['productId'] - int - product foreign key
 * $this->attributes['quantity'] - int - quantity of product
 * $this->attributes['unitPrice'] - float - price per unit
 * $this->attributes['created_at'] - timestamp - creation date
 * $this->attributes['updated_at'] - timestamp - last update date
 *
 * $this->order - Order - parent order
 * $this->product - Product - related product
 */
class OrderItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'orderId', 'productId', 'quantity', 'unitPrice'
    ];

    /**
     * Get the id of the order item.
     */
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    /**
     * Get the order id.
     */
    public function getOrderId(): int
    {
        return $this->attributes['orderId'];
    }

    /**
     * Set the order id.
     */
    public function setOrderId(int $orderId): void
    {
        $this->attributes['orderId'] = $orderId;
    }

    /**
     * Get the product id.
     */
    public function getProductId(): int
    {
        return $this->attributes['productId'];
    }

    /**
     * Set the product id.
     */
    public function setProductId(int $productId): void
    {
        $this->attributes['productId'] = $productId;
    }

    /**
     * Get the quantity.
     */
    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    /**
     * Set the quantity.
     */
    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    /**
     * Get the unit price.
     */
    public function getUnitPrice(): float
    {
        return $this->attributes['unitPrice'];
    }

    /**
     * Set the unit price.
     */
    public function setUnitPrice(float $unitPrice): void
    {
        $this->attributes['unitPrice'] = $unitPrice;
    }

    /**
     * Get the created at timestamp.
     */
    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    /**
     * Get the updated at timestamp.
     */
    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    /**
     * Get the parent order.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'orderId');
    }

    /**
     * Get the related product.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'productId');
    }
}
