<?php

namespace App\Enums\Appeal;

use App\Enums\BaseEnum;

enum AppealStatusEnum: string
{
    use BaseEnum;

    case NEW = 'A';

    case ACCEPTED = 'B';

    case REJECTED = 'C';
}
