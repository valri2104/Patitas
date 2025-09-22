<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Role;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * USER ATTRIBUTES
     * $this->attributes['id'] - int - contains the user primary key (ID)
     * $this->attributes['name'] - string - contains the user name
     * $this->attribute['email] - string - contains the user email
     * $this->attributes['phone'] - string - contains the user telephone number
     * $this->attributes['address'] - string - contains the user address
     * $this->attributes['password'] - string - contains the user password
     * $this->attributes['role'] - enum['Admin', 'Buyer', 'Veterinarian'] - contains the user role
     * $this->attributes['created_at'] - timestamp - contains the created date
     * $this->attributes['updated_at'] - timestamp - contains the updated date
     */
    protected $table = 'users';

    protected $fillable = ['name', 'email', 'phone', 'password', 'address', 'role'];

    public $timestamps = true;

    protected $casts = [
        'role'              => Role::class,
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    public function setEmail(string $email): void
    {
        $this->attributes['email'] = $email;
    }

    public function getPhone(): string
    {
        return $this->attributes['phone'];
    }

    public function setPhone(string $phone): void
    {
        $this->attributes['phone'] = $phone;
    }

    public function getAddress(): string
    {
        return $this->attributes['address'];
    }

    public function setAddress(string $address): void
    {
        $this->attributes['address'] = $address;
    }

    public function setPassword(string $password): void
    {
        $this->attributes['password'] = $password;
    }

    public function getCreatedAt(): Carbon
    {
        $value = $this->attributes['created_at'] ?? null;
        if ($value instanceof Carbon) {
            return $value;
        }
        return $value ? new Carbon($value) : Carbon::now();
    }

    public function getUpdatedAt(): Carbon
    {
        $value = $this->attributes['updated_at'] ?? null;
        if ($value instanceof Carbon) {
            return $value;
        }
        return $value ? new Carbon($value) : Carbon::now();
    }

    public function setRole(Role|string $role): void
    {
        if (is_string($role)) {
            $role = Role::from($role);
        }
        
        if (! in_array($role, [Role::Admin, Role::Buyer, Role::Veterinarian])) {
            return;
        }
        $this->attributes['role'] = $role->value;
    }

    public function getRole(): Role
    {
        return Role::from($this->attributes['role']);
    }

    public function isAdmin(): bool
    {
        return $this->getRole() === Role::Admin;
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
