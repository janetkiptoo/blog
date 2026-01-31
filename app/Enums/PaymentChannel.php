<?php


namespace App\Enums;

enum PaymentChannel: string
{
    case MPESA = 'mpesa';
    case CASH = 'cash';
}
