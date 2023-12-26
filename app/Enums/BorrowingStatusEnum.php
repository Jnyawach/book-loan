<?php

namespace App\Enums;

enum BorrowingStatusEnum: string
{


    case PENDING = 'Pending';
    case BORROWED = 'Borrowed';
    case EXTENDED = 'Extended';
    case DELAYED = 'Delayed';
    case RETURNED = 'Returned';

}
