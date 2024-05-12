<?php

namespace App\Enums;

enum JobStatus :string
{
    case EMPLOYEE = 'employee';

    case FREE = 'free';

    case RETIRED = 'retired';
}
