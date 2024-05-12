<?php

namespace App\Enums;

enum RequestsStatus: string
{
    case ACCEPTED = 'accepted';

    case INPROGRESS = 'in-progress';

    case REJECTED = 'rejected';
}
