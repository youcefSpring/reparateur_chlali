<?php

namespace App\Models;

use App\Enums\RecurringType;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
    protected $casts = [
        'recurring_type' => RecurringType::class,
        'status' => Status::class,
    ];
}
