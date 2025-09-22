<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'date_time', 'status', 'total', 'delivery_address', 'notes',
    ];

    // Getters
    public function getId(): int { return $this->attributes['id']; }
    public function getUserId(): int { return $this->attributes['user_id']; }
    public function getDateTime(): string { return $this->attributes['date_time']; }
    public function getStatus(): string { return $this->attributes['status']; }
    public function getTotal(): float { return $this->attributes['total']; }
    public function getDeliveryAddress(): string { return $this->attributes['delivery_address']; }
    public function getNotes(): ?string { return $this->attributes['notes'] ?? null; }

    // Setters
    public function setUserId(int $userId): void { $this->attributes['user_id'] = $userId; }
    public function setDateTime(string $dateTime): void { $this->attributes['date_time'] = $dateTime; }
    public function setStatus(string $status): void { $this->attributes['status'] = $status; }
    public function setTotal(float $total): void { $this->attributes['total'] = $total; }
    public function setDeliveryAddress(string $address): void { $this->attributes['delivery_address'] = $address; }
    public function setNotes(?string $notes): void { $this->attributes['notes'] = $notes; }

    // Relaciones
    public function user() { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(OrderItem::class); }
}
