<?php

namespace App\Enums;

enum BorrowingStatusEnum: string
{

    case AVAILABLE = 'Available';
    case PENDING = 'Pending';
    case BORROWED = 'Borrowed';
    case Extended = 'Extended';
    case DELAYED = 'Delayed';

}
