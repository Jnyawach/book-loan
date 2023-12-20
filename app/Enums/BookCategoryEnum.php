<?php

namespace App\Enums;

enum BookCategoryEnum:string
{

    case FICTION = 'Fiction';
    case NON_FICTION = 'Non-fiction';
    case REFERENCE = 'Reference';

    case NOVEL = 'Novel';
    case POETRY = 'Poetry';
    case SHORT_STORY = 'Short-story';

    case OTHER = 'Other';
}
