<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_id',
        'branch_id',
        'customer_id',
        'or_number',
        'prepared_by_id',
        'cancelled_by_id',
        'is_approved',
        'is_cancelled',
        'date',
        'status',
    ];

    public function bill(): BelongsTo
    {
        return $this->belongsTo(Bill::class);
    }

    public function payment_details(): HasMany
    {
        return $this->hasMany(PaymentDetail::class);
    }
}
