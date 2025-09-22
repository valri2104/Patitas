<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VeterinaryAppointment extends Model
{
    /**
     * VETERINARY APPOINTMENT ATTRIBUTES
     * $this->attributes['id'] - int - veterinary appointment primary key
     * $this->attributes['date_time'] - datetime - appointment date and time
     * $this->attributes['service_type'] - string - type of veterinary service
     * $this->attributes['status'] - string - appointment status (programada, confirmada, completada, cancelada)
     * $this->attributes['notes'] - string - appointment notes
     * $this->attributes['user_id'] - int - foreign key to user (pet owner)
     * $this->attributes['veterinarian_id'] - int - foreign key to user (veterinarian)
     * $this->attributes['created_at'] - timestamp - creation date
     * $this->attributes['updated_at'] - timestamp - last update date
     *
     * $this->user - User - user who owns the appointment (pet owner)
     * $this->veterinarian - User - veterinarian assigned to the appointment
     */

    /** @use HasFactory<\Database\Factories\VeterinaryAppointmentFactory> */
    use HasFactory;

    protected $fillable = [
        'date_time',
        'service_type',
        'status',
        'notes',
        'user_id',
        'veterinarian_id',
    ];

    protected $casts = [
        'date_time' => 'datetime',
    ];

    // Getters and Setters

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getDateTime(): string
    {
        return $this->attributes['date_time'];
    }

    public function setDateTime(string $dateTime): void
    {
        $this->attributes['date_time'] = $dateTime;
    }

    public function getServiceType(): string
    {
        return $this->attributes['service_type'];
    }

    public function setServiceType(string $serviceType): void
    {
        $this->attributes['service_type'] = $serviceType;
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function setStatus(string $status): void
    {
        $this->attributes['status'] = $status;
    }

    public function getNotes(): ?string
    {
        return $this->attributes['notes'] ?? null;
    }

    public function setNotes(?string $notes): void
    {
        $this->attributes['notes'] = $notes;
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    public function getVeterinarianId(): ?int
    {
        return $this->attributes['veterinarian_id'] ?? null;
    }

    public function setVeterinarianId(?int $veterinarianId): void
    {
        $this->attributes['veterinarian_id'] = $veterinarianId;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    // Relationships

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function veterinarian(): BelongsTo
    {
        return $this->belongsTo(User::class, 'veterinarian_id');
    }

    public function getVeterinarian(): ?User
    {
        return $this->veterinarian;
    }

    // Business Logic Methods

    /**
     * Check if there's a time conflict with another appointment
     */
    public static function hasTimeConflict(string $dateTime, ?int $excludeId = null): bool
    {
        $query = self::where('date_time', $dateTime)
            ->whereIn('status', ['programada', 'confirmada']);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }
}
