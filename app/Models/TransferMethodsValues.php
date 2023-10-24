<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class TransferMethodsValues extends Model
{
    use HasFactory;

    protected $fillable = [
        'transfer_wallet_name',
        'transfer_wallet_icon',
        'receive_wallet_name',
        'receive_wallet_icon',
        'min_value',
        'max_value',
        'commission',
        'receive_wallet_name',
        'recieve_wallet_code',

    ];

    protected $casts = [
        'min_value' => 'double',
        'max_value' => 'double',
        'commission' => 'double'
    ];

    public function deposit(): BelongsTo
    {
        return $this->belongsTo(DepositMethods::class, 'deposit_id');
    }
  
}
