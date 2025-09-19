<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case Buyer = 'buyer';
    case Veterinarian = 'veterinarian';
}
