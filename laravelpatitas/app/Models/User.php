<?php

/**
 * Developed by: Valeria Cardona
 */

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Role;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * USER ATTRIBUTES
     * $this->attributes['id'] - int - contains the user primary key (ID)
     * $this->attributes['name'] - string - contains the user name
     * $this->attributes['email'] - string - contains the user email
     * $this->attributes['phone'] - string - contains the user telephone number
     * $this->attributes['address'] - string - contains the user address
     * $this->attributes['balance'] - float - contains the available balance for purchases
     * $this->attributes['password'] - string - contains the user password
     * $this->attributes['role'] - enum[Role::class] - contains the user role
     * $this->attributes['created_at'] - timestamp - contains the created date
     * $this->attributes['updated_at'] - timestamp - contains the updated date
     *
     * $this->review - Review[] - reviews that were made for the user
     * $this->order - Order[] - orders that were made for the user
     * $this->appointments - Appointment[] - veterinary appointments made by the user
     */
    protected $table = 'users';

    protected $fillable = ['name', 'email', 'phone', 'password', 'address', 'role', 'balance'];

    public $timestamps = true;

    protected $casts = [
        'role'              => Role::class,
        'email_verified_at' => 'datetime',
        'balance'           => 'decimal:2',
    ];

    protected $hidden = [
        'password',
        'remember_token',
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
        $this->attributes['name'] = ucwords($name);
    }

    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    public function setEmail(string $email): void
    {
        $this->attributes['email'] = $email;
    }

    public function getPhone(): ?string
    {
        return $this->attributes['phone'];
    }

    public function setPhone(?string $phone): void
    {
        $this->attributes['phone'] = $phone;
    }

    public function getAddress(): ?string
    {
        return $this->attributes['address'];
    }

    public function setAddress(?string $address): void
    {
        $this->attributes['address'] = $address;
    }

    public function getBalance(): float
    {
        return (float) $this->attributes['balance'];
    }

    public function setBalance(float $balance): void
    {
        $this->attributes['balance'] = $balance;
    }

    public function hasBalance(float $amount): bool
    {
        return $this->getBalance() >= $amount;
    }

    public function decreaseBalance(float $amount): void
    {
        if ($amount <= 0.0) {
            return;
        }

        if (! $this->hasBalance($amount)) {
            return;
        }

        $this->setBalance($this->getBalance() - $amount);
    }

    public function setPassword(string $password): void
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function getCreatedAt(): ?Carbon
    {
        return isset($this->attributes['created_at'])
        ? Carbon::parse($this->attributes['created_at'])
        : null;
    }

    public function getUpdatedAt(): Carbon
    {
        return isset($this->attributes['updated_at'])
        ? Carbon::parse($this->attributes['updated_at'])
        : null;
    }

    public function setRole(Role|string $role): void
    {
        if (is_string($role)) {
            $role = Role::from($role);
        }
        $this->attributes['role'] = $role->value;
    }

    public function getRole(): Role
    {
        return Role::from($this->attributes['role'] ?? Role::Buyer->value);
    }

    public function isAdmin(): bool
    {
        return $this->getRole() === Role::Admin;
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
