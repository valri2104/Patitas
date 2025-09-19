<?php

use App\Enum;

enum Role: string
{
    case ADMIN = 'Admin';
    case BUYER = 'Buyer';
    case VETERINARIAN = 'Veterinarian';
}
