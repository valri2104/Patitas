<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    /**
     * ORDER ATTRIBUTES
     * $this->attributes['id'] - int - order primary key
     * $this->attributes['user_id'] - int - foreign key to users table
     * $this->attributes['orderDate'] - DateTime - date when the order was placed
     * $this->attributes['status'] - string - order status
     * $this->attributes['total'] - float - total amount of the order
     * $this->attributes['deliveryAddress'] - string - delivery address for the order
     * $this->attributes['created_at'] - timestamp - creation date
     * $this->attributes['updated_at'] - timestamp - last update date
     *
     * $this->user - User - the user who placed the order
     * $this->orderItems - OrderItem[] - the items in this order
     */
    protected $fillable = ['user_id', 'orderDate', 'status', 'total', 'deliveryAddress'];

    protected $casts = [
        'orderDate' => 'datetime',
        'total'     => 'float',
    ];

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

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function setStatus(string $status): void
    {
        $this->attributes['status'] = $status;
    }

    public function getTotal(): float
    {
        return $this->attributes['total'];
    }

    public function setTotal(float $total): void
    {
        $this->attributes['total'] = $total;
    }

    public function getOrderDate(): \DateTime
    {
        return $this->attributes['orderDate'];
    }

    public function setOrderDate(\DateTime $orderDate): void
    {
        $this->attributes['orderDate'] = $orderDate;
    }

    public function getDeliveryAddress(): string
    {
        return $this->attributes['deliveryAddress'];
    }

    public function setDeliveryAddress(string $deliveryAddress): void
    {
        $this->attributes['deliveryAddress'] = $deliveryAddress;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getOrderItems(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->orderItems;
    }

    /**
     * Calculate the total amount of the order
     */
    public function calculateTotal(): float
    {
        $total = 0;

        foreach ($this->getOrderItems() as $orderItem) {
            $total += $orderItem->calculateSubtotal();
        }

        return $total;
    }
}
