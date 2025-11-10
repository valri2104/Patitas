<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    /**
     * APPOINTMENT ATTRIBUTES
     * $this->attributes['id'] - int - appointment primary key
     * $this->attributes['user_id'] - int - foreign key to users table
     * $this->attributes['date'] - date - appointment date
     * $this->attributes['time'] - time - appointment time
     * $this->attributes['pet_name'] - string - name of the pet
     * $this->attributes['pet_type'] - string - type of pet (dog, cat, etc)
     * $this->attributes['reason'] - string - reason for appointment
     * $this->attributes['status'] - string - appointment status (pending, confirmed, completed, cancelled)
     * $this->attributes['created_at'] - timestamp - creation date
     * $this->attributes['updated_at'] - timestamp - last update date
     *
     * $this->user - User - appointment owner
     */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'time',
        'pet_name',
        'pet_type',
        'reason',
        'status',
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

    public function getDate(): string
    {
        return $this->attributes['date'];
    }

    public function setDate(string $date): void
    {
        $this->attributes['date'] = $date;
    }

    public function getTime(): string
    {
        return $this->attributes['time'];
    }

    public function setTime(string $time): void
    {
        $this->attributes['time'] = $time;
    }

    public function getPetName(): string
    {
        return $this->attributes['pet_name'];
    }

    public function setPetName(string $petName): void
    {
        $this->attributes['pet_name'] = $petName;
    }

    public function getPetType(): string
    {
        return $this->attributes['pet_type'];
    }

    public function setPetType(string $petType): void
    {
        $this->attributes['pet_type'] = $petType;
    }

    public function getReason(): string
    {
        return $this->attributes['reason'];
    }

    public function setReason(string $reason): void
    {
        $this->attributes['reason'] = $reason;
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function setStatus(string $status): void
    {
        $this->attributes['status'] = $status;
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

    public function getUser(): User
    {
        return $this->user;
    }
}
