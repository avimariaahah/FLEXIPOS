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
        'branch_no',
        'or_number',
        'customer_id',
        'is_approved',
        'is_cancelled',
        'payment_date',
        'prepared_by_id',
        'cancelled_by_id',
        'approvedby',
        'remarks',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function prepared_by(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function payment_details(): HasMany
    {
        return $this->hasMany(PaymentDetail::class);
    }
}
