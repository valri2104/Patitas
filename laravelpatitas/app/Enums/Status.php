<?php

namespace App\Enums;

enum Status: string
{
    case pending        = 'pending';
    case confirmed        = 'confirmed';
    case shipped = 'shipped';
    case delivered = 'delivered';
    case cancelled = 'cancelled';
}
