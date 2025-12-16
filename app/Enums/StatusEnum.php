<?php

namespace App\Enums;

use App\Enums\BaseEnum;

enum StatusEnum: string
{
    use BaseEnum;

    case ACTIVE  = 'A';

    case DISABLE = 'B';

    case HIDDEN  = 'C';
}
