<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUuids;

    private $fillable = [
        'user_id', 
        'product_name', 
        'amount', 
        'status'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function notificationLogs() { return $this->hasMany(NotificationLog::class); }
}

