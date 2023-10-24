<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'send_amount',
        'receive_amount',
        'commission',
        'from_wallet',
        'from_wallet_icon',
        'to_wallet',
        'to_wallet_icon',
        'admin_wallet',
        'user_wallet_id',
        'user_op_code',
        'user_image',
        'user_full_name',
        'user_phone',
        'user_place',
        'user_email',
        'admin_op_code',
        'admin_image',
        'message',
        'status',
    ];

    protected $casts = [
        'send_amount'=> 'double',
        'receive_amount'=> 'double',
        'commission'=> 'double',
        'status'=> 'integer',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

   
}
