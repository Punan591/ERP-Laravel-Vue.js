<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ClientStatus;
use App\Http\Controllers\Controller;
use App\Models\Client;

class ClientStatusController extends Controller
{
    public function getStatusWithCount()
    {
        $cases = ClientStatus::cases();

        return collect($cases)->map(function ($status) {
            return [
                'name' => $status->name,
                'value' => $status->value,
                'count' => Client::where('status', $status->value)->count(),
                'color' => ClientStatus::from($status->value)->color(),
            ];
        });
    }
}
