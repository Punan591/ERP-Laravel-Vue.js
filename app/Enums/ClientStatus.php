<?php

namespace App\Enums;

enum ClientStatus: int
{
    case ACTIVE = 1;
    case INACTIVE = 2;
    //case CANCELLED = 3;

    public function color(): string
    {
        return match ($this) {
            CLientStatus::ACTIVE => 'primary',
           // AppointmentStatus::CONFIRMED => 'success',
            ClientStatus::INACTIVE => 'danger',
        };
    }
}
