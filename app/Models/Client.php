<?php

namespace App\Models;

use App\Enums\ClientStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => ClientStatus::class
    ];

   
}
