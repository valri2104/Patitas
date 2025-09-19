<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'Admin';
    case BUYER = 'Buyer';
    case VETERINARIAN = 'Veterinarian';
}
